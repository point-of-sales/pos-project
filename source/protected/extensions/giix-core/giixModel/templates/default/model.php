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


    public function them($params) {
        // kiem tra du lieu con bi trung hay chua

        if(!$this->kiemTraTonTai($params)) {
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
        <?php if ($crud->hasManyManyRelation($modelClass)): ?>
            $relatedData = <?php echo $crud->generateGetPostRelatedData($modelClass, 4); ?>;
        <?php endif; ?>
        if(!$this->kiemTraTonTai($params)) {
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
        if($this->soKhopMa($params)) {
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


    public function xuatFileExcel() {
        $criteria = new CDbCriteria;

        <?php foreach($columns as $name=>$column): ?>
            <?php $partial = ($column->type==='string' and !$column->isForeignKey); ?>
            $criteria->compare('<?php echo $name; ?>', $this-><?php echo $name; ?><?php echo $partial ? ', true' : ''; ?>);
        <?php endforeach; ?>

        $event = new CPOSSessionEvent();
        $event->currentSession = Yii::app()->session['<?php echo $modelClass; ?>'];
        $this->onAfterExport($event);

        return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
        ));
        }


}