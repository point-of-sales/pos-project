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

class CPOSActiveRecord extends CActiveRecord {

    protected  function kiemTraQuanHe()
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

    protected  function kiemTraTonTai($params) {
        $uniqueKeyLabel = $this->timKhoaUnique($this->getAttributes());
        if (empty($uniqueKeyLabel)) {
            $primaryKeys = $this->tableSchema->primaryKey; //neu khong co truong ma_ . Dung Primary key thay the
            if(is_array($primaryKeys))  {                        //neu primary keys la mang
                $conditions = array();
                foreach($primaryKeys as $key) {
                    $conditions[$key] = $params[$key];
                }
                return  $this->exists($conditions);
            }
            else
                return $this->exists($primaryKeys . '=:' . $primaryKeys, array(':' . $primaryKeys => $params[$primaryKeys]));
        } else {
            // co ton tai truong ma_ (co khoa Unique)
            return $this->exists($uniqueKeyLabel . '=:' . $uniqueKeyLabel, array(':' . $uniqueKeyLabel => $params[$uniqueKeyLabel]));
        }
    }

    /*
     * So sanh ma voi doi so params. Thu tu so sanh tu Khoa Unique->PrimaryKey
     */

    protected  function soKhopMa($params) {
        $uniqueKeyLabel = $this->timKhoaUnique($this->getAttributes());
        if (empty($uniqueKeyLabel)) {
            $primaryKeys = $this->tableSchema->primaryKey; //neu khong co truong ma_ . Dung Primary key thay the
            if(is_array($primaryKeys))  {                        //neu primary keys la mang
                $oldPrimaryValues = array();
                foreach($primaryKeys as $key) {
                    $oldPrimaryValues[$key] = $this->getAttribute($key);
                }
                return  Helpers::compareArray($oldPrimaryValues,$params);
            }
            else
                return $this->getAttribute($primaryKeys) == $params[$primaryKeys];
        } else {
            // co ton tai truong ma_ (co khoa Unique)
            return $this->getAttribute($uniqueKeyLabel) == $params[$uniqueKeyLabel];
        }

    }

    protected  function timKhoaUnique($schema)
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

    protected  function afterExport() {
        if($this->hasEventHandler('onAfterExport'))
            $this->onAfterExport(new CEvent($this));
    }
    /*
    * Dinh nghia event after export. Event that su duoc trigger o day. $event la CSessionEvent chua session
    */

    public function onAfterExport($event) {
        $this->raiseEvent('onAfterExport',$event);

    }

}