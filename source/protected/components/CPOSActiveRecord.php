<?php
/**
 * User: ${Cristazn}
 * Date: 4/18/13
 * Time: 11:12 PM
 * Email: crist.azn@gmail.com | Phone : 0963-500-980
 */

/*
 * Lop ke thua CActiveRecord, dung de them cac method vao tat ca cac lop trong models
 * Lop con la : GxActiveRecord
 */

abstract class CPOSActiveRecord extends GxActiveRecord
{
    //neu chua co ma thi truyen ma_chung_tu = ""
    public function taoMaChungTuMoi($ma_chung_tu,$tiep_dong_ngu,$do_dai){
        //print_r('dsd');exit;
        if($ma_chung_tu != ""){
            $ma_chung_tu = substr($ma_chung_tu,2);
            $ma_chung_tu = ((int)$ma_chung_tu)+1;
        }
        else{
            $ma_chung_tu = 1;
        }
        $str = "";
        $do_dai = $do_dai-strlen($tiep_dong_ngu)-strlen($ma_chung_tu);
        for($i=0;$i<$do_dai;$i++){
            $str.='0';
        }
        $str = $tiep_dong_ngu.$str.$ma_chung_tu;
        return $str;
    }

    protected function kiemTraQuanHe()
    {
        $rels = $this->relations();
        $i = 0;
        foreach ($rels as $relLabel => $value) {
            $i++;
            if ($value[0] != parent::BELONGS_TO) {
                $tmp = $this->getRelated($relLabel);
                if (!empty($tmp) && !($tmp[0] instanceof AuthAssignment)) {

                    return true;
                }
            }
        }
        return false;
    }

    /*
     * Tra ve ket qua du lieu nhap tu params - bien POST (cac khoa chinh hoac khoa Unique) co ton tai hay chua
     */

    protected function kiemTraTonTai($params)
    {
        $uniqueKeyLabel = $this->timKhoaUnique($this->getAttributes());
        if (empty($uniqueKeyLabel)) {
            $primaryKeys = $this->tableSchema->primaryKey; //neu khong co truong ma_ . Dung Primary key thay the
            if (is_array($primaryKeys)) { //neu primary keys la mang
                $conditions = array();
                foreach ($primaryKeys as $key) {
                    $conditions[$key] = $params[$key];
                }
                return $this->exists($conditions);
            } else
                return $this->exists($primaryKeys . '=:' . $primaryKeys, array(':' . $primaryKeys => $params[$primaryKeys]));
        } else {
            // co ton tai truong ma_ (co khoa Unique)
            return $this->exists($uniqueKeyLabel . '=:' . $uniqueKeyLabel, array(':' . $uniqueKeyLabel => $params[$uniqueKeyLabel]));
        }
    }

    /*
     * So sanh ma voi doi so params. Thu tu so sanh tu Khoa Unique->PrimaryKey
     */

    protected function soKhopMa($params)
    {
        $uniqueKeyLabel = $this->timKhoaUnique($this->getAttributes());
        if (empty($uniqueKeyLabel)) {
            $primaryKeys = $this->tableSchema->primaryKey; //neu khong co truong ma_ . Dung Primary key thay the
            if (is_array($primaryKeys)) { //neu primary keys la mang
                $oldPrimaryValues = array();
                foreach ($primaryKeys as $key) {
                    $oldPrimaryValues[$key] = $this->getAttribute($key);
                }
                return Helpers::compareArray($oldPrimaryValues, $params);
            } else
                return $this->getAttribute($primaryKeys) == $params[$primaryKeys];
        } else {
            // co ton tai truong ma_ (co khoa Unique)
            return $this->getAttribute($uniqueKeyLabel) == $params[$uniqueKeyLabel];
        }

    }

    protected function timKhoaUnique($schema)
    {
        foreach ($schema as $k => $v) {
            if (substr($k, 0, 3) == 'ma_') {
                return $k;
            }
        }
    }

    /*
    * Method cho lop ke thua override goi duoc method cua lop cha
    */

    protected function afterExport()
    {
        if ($this->hasEventHandler('onAfterExport'))
            $this->onAfterExport(new CEvent($this));
    }

    /*
    * Dinh nghia event after export. Event that su duoc trigger o day. $event la CSessionEvent chua session
    */

    public function onAfterExport($event)
    {
        $this->raiseEvent('onAfterExport', $event);

    }

    public function isValidDate($date)
    {
        $dateParsed = date_parse($date);
        return $dateParsed['error_count'] == 0;
    }

    /*
     * Method chuyen dinh dang ngay thang tu dinh dang Y-m-d ve dinh dang mac dinh la dinh dang : d-m-Y
     */

    public function formatDate($attribute, $format = 'd-m-Y')
    {
        if ($this->isValidDate($this->getAttribute($attribute))) ;
        $this->setAttribute($attribute, date($format, strtotime($this->getAttribute($attribute))));
    }

    public function layDanhSachTrangThai()
    {
        return array('Chưa kích hoạt', 'Kích hoạt');
    }

    public function layTenTrangThai()
    {
        if ($this->hasAttribute('trang_thai')) {
            $danhSachTrangThai = $this->layDanhSachTrangThai();
            return $danhSachTrangThai[$this->getAttribute('trang_thai')];
        } else
            return '';
    }

    /*
     * event duoc thuc thi sau moi dong duoc khoi tao (instantiated) boi phuong thuc find
     */
    public function afterFind()
    {
        // kiem tra xem co truong nao la kieu du lieu date. Chuyen thanh dang d-m-Y
        $tableSchema = $this->getTableSchema();
        $columnNames = $tableSchema->getColumnNames();
        foreach ($columnNames as $column) {
            $columnSchema = $tableSchema->getColumn($column);
            if ($columnSchema->dbType == 'date')
                $this->formatDate($column);

        }
    }

    /*
     * event duoc thuc thi truoc khi 1 record duoc luu vao trong du lieu,
     * chuyen du lieu kieu date tu d-m-Y sang Y-m-d de luu vao trong CSDL
     */

    public function beforeSave()
    {
        if (parent::beforeSave()) {
            $tableSchema = $this->getTableSchema();
            $columnNames = $tableSchema->getColumnNames();
            foreach ($columnNames as $column) {
                $columnSchema = $tableSchema->getColumn($column);
                if ($columnSchema->dbType == 'date')
                    $this->formatDate($column, 'Y-m-d');
            }
            return true;
        }
    }


    public function saveWithRelated($relatedData, $runValidation = true, $attributes = null, $options = array(), $hasExtraFields = false, $hasExtraBehaviour = false)
    {
        // Merge the specified options with the default options.
        $options = array_merge(
        // The default options.
            array(
                'withTransaction' => true,
                'batch' => true,
            )
            ,
            // The specified options.
            $options
        );

        try {
            // Start the transaction if required.
            if ($options['withTransaction'] && ($this->getDbConnection()->getCurrentTransaction() === null)) {
                $transacted = true;
                $transaction = $this->getDbConnection()->beginTransaction();
            } else
                $transacted = false;

            // Save the main model.
            if (!$this->save($runValidation, $attributes)) {
                if ($transacted)
                    $transaction->rollback();
                return false;
            }

            // If there is related data, call saveRelated.
            if (!empty($relatedData)) {


                if (!$this->saveRelated($relatedData, $runValidation, $options['batch'], $hasExtraFields, $hasExtraBehaviour)) {
                    if ($transacted)
                        $transaction->rollback();
                    return false;
                }
            }

            // If transacted, commit the transaction.
            if ($transacted)
                $transaction->commit();
        } catch (Exception $ex) {
            // If there is an exception, roll back the transaction...
            if ($transacted)
                $transaction->rollback();
            // ... and rethrow the exception.
            throw $ex;
        }
        return true;
    }

    protected function saveRelated($relatedData, $runValidation = true, $batch = true, $hasExtraFields, $hasExtraBehaviour)
    {
        if (empty($relatedData))
            return true;

        // This active record can't be new for the method to work correctly.
        if ($this->getIsNewRecord())
            throw new CDbException(Yii::t('giix', 'Cannot save the related records to the database because the main record is new.'));

        // Save each related data.
        // [SP001] => Array(30,60000), [SP003] => Array(40,80000)



        if ($hasExtraFields) {
            $pivotName = array_keys($relatedData);
            $relatedExtraData = array();
            if(!empty($pivotName)) {
                foreach($pivotName as $pv) {
                    foreach ($relatedData[$pv] as $key => $value) {
                        $relatedExtraData[] = $value;
                    }
                    // recreate $relatedData
                    $tmp[$pv] = array_keys($relatedData[$pv]);

                }
                unset($relatedData);
                $relatedData = $tmp;
                unset($tmp);

            }

        }

        foreach ($relatedData as $relationName => $relationData) {
            // The pivot model class name.
            $pivotClassNames = $this->pivotModels();
            $pivotClassName = $pivotClassNames[$relationName];
            $pivotModelStatic = GxActiveRecord::model($pivotClassName);
            // Get the foreign key names for the models.
            $activeRelation = $this->getActiveRelation($relationName);

            $relatedClassName = $activeRelation->className;
            if (preg_match('/(.+)\((.+),\s*(.+)\)/', $activeRelation->foreignKey, $matches)) {
                // By convention, the first fk is for this model, the second is for the related model.
                $thisFkName = $matches[2];
                $relatedFkName = $matches[3];
            }

            // Get the primary key value of the main model.
            $thisPkValue = $this->getPrimaryKey();

            if (is_array($thisPkValue))
                throw new Exception(Yii::t('giix', 'Composite primary keys are not supported.'));
            // Get the current related models of this relation and map the current related primary keys.

            $currentRelation = $pivotModelStatic->findAll(new CDbCriteria(array(
                'select' => $relatedFkName,
                'condition' => "$thisFkName = :thisfkvalue",
                'params' => array(':thisfkvalue' => $thisPkValue),
            )));

            $currentMap = array();
            foreach ($currentRelation as $currentRelModel) {
                $currentMap[] = $currentRelModel->$relatedFkName;
            }
            // Compare the current map to the new data and identify what is to be kept, deleted or inserted.
            $newMap = $relationData;
            $deleteMap = array();
            $insertMap = array();
            if ($newMap !== null) {
                if ($hasExtraBehaviour) {
                    foreach ($newMap as $newItem) {
                        if (!in_array($newItem, $currentMap)) {
                            // insert item
                            $insertMap[] = $newItem;
                        } else {
                            // replace old item with newitem
                            $deleteMap[] = $newItem;
                            $insertMap[] = $newItem;
                        }
                    }
                } else {

                    // Identify the relations to be deleted.
                    foreach ($currentMap as $currentItem) {
                        if (!in_array($currentItem, $newMap))
                            $deleteMap[] = $currentItem;
                    }
                    // Identify the relations to be inserted.
                    foreach ($newMap as $newItem) {
                        if (!in_array($newItem, $currentMap))
                            $insertMap[] = $newItem;
                    }

                }

            } else // If the new data is empty, everything must be deleted.
                $deleteMap = $currentMap;
            // If nothing changed, we simply continue the loop.
            if (empty($deleteMap) && empty($insertMap))
                continue;
            // Now act inserting and deleting the related data: first prepare the data.
            // Inject the foreign key names of both models and the primary key value of the main model in the maps.
            foreach ($deleteMap as &$deleteMapPkValue)
                $deleteMapPkValue = array_merge(array($relatedFkName => $deleteMapPkValue), array($thisFkName => $thisPkValue));
            unset($deleteMapPkValue); // Clear reference;
            foreach ($insertMap as &$insertMapPkValue)
                $insertMapPkValue = array_merge(array($relatedFkName => $insertMapPkValue), array($thisFkName => $thisPkValue));
            unset($insertMapPkValue); // Clear reference;
            // Now act inserting and deleting the related data: then execute the changes.
            // Delete the data.
            if (!empty($deleteMap)) {
                if ($batch) {
                    // Delete in batch mode.
                    if ($pivotModelStatic->deleteByPk($deleteMap) !== count($deleteMap)) {
                        return false;
                    }
                } else {
                    // Delete one active record at a time.
                    foreach ($deleteMap as $value) {
                        $pivotModel = GxActiveRecord::model($pivotClassName)->findByPk($value);
                        if (!$pivotModel->delete()) {
                            return false;
                        }
                    }
                }
            }

            // Insert the new data.

            foreach ($insertMap as $value) {
                $pivotModel = new $pivotClassName();
                if ($hasExtraFields) {
                    $extraFields = Helpers::array_cut($relatedExtraData);
                    $value = array_merge($value, $extraFields);
                }
                $pivotModel->setAttributes($value);
                if (!$pivotModel->save($runValidation)) {
                    return false;
                }
            }
        } // This is the end of the loop "save each related data".

        return true;
    }

}