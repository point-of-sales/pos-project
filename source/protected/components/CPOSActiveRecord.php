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

class CPOSActiveRecord extends GxActiveRecord
{

    protected function kiemTraQuanHe()
    {
        $rels = $this->relations();
        foreach ($rels as $relLabel => $value) {
            if ($value[0] != parent::BELONGS_TO) {
                $tmp = $this->getRelated($relLabel);
                if (!empty($tmp))
                    return true;

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

}