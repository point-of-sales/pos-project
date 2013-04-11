<?php
/**
 * This is the template for generating the model class of a specified table.
 * In addition to the default model Code, this adds the CSaveRelationsBehavior
 * to the model class definition.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 * - $representingColumn: the name of the representing column for the table (string) or
 *   the names of the representing columns (array)
 */
Yii::import('ext.giix-core.giixCrud.*');
?>
<?php echo "<?php\n"; ?>

Yii::import('<?php echo "{$this->baseModelPath}.{$this->baseModelClass}"; ?>');

class <?php echo $modelClass; ?> extends <?php echo $this->baseModelClass."\n"; ?>
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}


    public static function layDanhSach($primaryKey=-1, $params=array(), $operator='AND',$limit=-1,$order='',$orderType='ASC') {
        $criteria = new CDbCriteria();
        if($primaryKey > 0) {
            return <?php echo $modelClass; ?>::model()->findByPk($primaryKey);
        }

        if(!empty($params)) {
            if(is_array($params) ) {
                foreach($params as $cond=>$value) {
                if($criteria->condition=='') {
                if(is_string($value)) {
                    $value = stripcslashes($value);
                    $value = addslashes($value);
                }
                    $criteria->condition = $cond .'='."'$value'" . ' AND ';
                } else {
                    $criteria->condition = $criteria->condition . ' ' .  $cond .'='."'$value'" . ' AND ';
                }
            }

                $criteria->condition = substr($criteria->condition,0,strlen($criteria->condition)-5);

                if($operator=='OR') {
                    //replace AND with OR
                    $criteria->condition = str_replace(' AND ',' OR ', $criteria->condition);
                }

            } else {
                $criteria->condition = $params;
            }

            if($limit > 0) {
                $criteria->limit = $limit;
            }

            if($order!='') {
                $criteria->order = $order .' ' .$orderType;
            }
                return <?php echo $modelClass; ?>::model()->findAll($criteria);
            } else {

                return <?php echo $modelClass; ?>::model()->findAll();
            }
        }

    public function kiemTraQuanHe() {
        $rels = $this->relations();
        foreach($rels as $relLabel=>$value) {
            if($value[0]!=parent::BELONGS_TO) {
                $tmp = $this->getRelated($relLabel);
                if(!empty($tmp)) {
                    return true;
                }
            }
        }
        return false;
    }
    private  function timKhoaUnique($schema) {
        foreach($schema as $k=>$v) {
            if(substr($k,0,3)=='ma_') {
                return $k;
            }
        }
    }
    public function them($params) {
        // kiem tra du lieu con bi trung hay chua
        $uniqueKeyLabel = $this->timKhoaUnique($this->getAttributes());
        $exist = $this->exists($uniqueKeyLabel .'=:'. $uniqueKeyLabel,array(':'.$uniqueKeyLabel=>$params[$uniqueKeyLabel]));
        if(!$exist) {
            //neu khoa chua ton tai
            $this->setAttributes($params);
        <?php $crud = new GiixCrudCode();
            if ($crud->hasManyManyRelation($modelClass)): ?>
            $relatedData = <?php echo $crud->generateGetPostRelatedData($modelClass, 4); ?>;
        <?php endif; ?>
        <?php if ($crud->hasManyManyRelation($modelClass)): ?>
            if ($this->saveWithRelated($relatedData))
        <?php else: ?>
            if ($this->save())
        <?php endif; ?>
                return 'ok';
            else
                return 'fail';
        } else
                return 'dup-error';
    }

    public function capNhat($params) {
        // kiem tra du lieu con bi trung hay chua
        $uniqueKeyLabel = $this->timKhoaUnique($this->getAttributes());
        // lay ma_ cu
        $uniqueKeyOldVal = $this->getAttribute($uniqueKeyLabel);
        $exist = $this->exists($uniqueKeyLabel .'=:'. $uniqueKeyLabel,array(':'.$uniqueKeyLabel=>$params[$uniqueKeyLabel]));
        <?php if ($crud->hasManyManyRelation($modelClass)): ?>
            $relatedData = <?php echo $crud->generateGetPostRelatedData($modelClass, 4); ?>;
        <?php endif; ?>
        if(!$exist) {
            $this->setAttributes($params);
            <?php if ($crud->hasManyManyRelation($modelClass)): ?>
                if ($this->saveWithRelated($relatedData))
            <?php else: ?>
                if ($this->save())
            <?php endif; ?>
                    return 'ok';
                else
                    return 'fail';
        } else {

        // so sanh ma cu == ma moi
        if($uniqueKeyOldVal == $params[$uniqueKeyLabel]) {
            $this->setAttributes($params);
            <?php if ($crud->hasManyManyRelation($modelClass)): ?>
                if ($this->saveWithRelated($relatedData))
            <?php else: ?>
                if ($this->save())
            <?php endif; ?>
                    return 'ok';
                else
                    return 'fail';
        } else
                return 'dup-error';

        }
    }

    public function xoa() {
        $relation = $this->kiemTraQuanHe($this->id);
        if(!$relation) {
            if($this->delete())
                return 'ok';
            else
                return 'fail';
        } else {
            return 'rel-error';
        }
    }


}