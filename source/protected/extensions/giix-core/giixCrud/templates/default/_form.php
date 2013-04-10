<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<div class="form">

<?php echo '<?php  if(Yii::app()->user->hasFlash(\'info-board\')) {?>'; ?>
    <?php echo '<div class="response-msg error ui-corner-all info-board">'; ?>
        <?php echo '<?php echo Yii::app()->user->getFlash(\'info-board\');?>'; ?>
    <?php echo '</div>'; ?>
<?php echo '<?php } ?>';?>

<?php $ajax = ($this->enable_ajax_validation) ? 'true' : 'false'; ?>

<?php echo '<?php '; ?>
$form = $this->beginWidget('GxActiveForm', array(
	'id' => '<?php echo $this->class2id($this->modelClass); ?>-form',
	'enableAjaxValidation' => <?php echo $ajax; ?>,
));
<?php echo '?>'; ?>


	<p class="note">
		<?php echo "<?php echo Yii::t('viLib', 'Fields with'); ?> <span class=\"required\">*</span> <?php echo Yii::t('viLib', 'are required'); ?>"; ?>.
	</p>

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php foreach ($this->tableSchema->columns as $column): ?>
<?php if (!$column->autoIncrement): ?>
		<div class="row cus-row">
		<?php echo "<?php echo " . $this->generateActiveLabel($this->modelClass, $column) . "; ?>\n"; ?>
		<?php echo "<?php " . $this->generateActiveField($this->modelClass, $column) . "; ?>\n"; ?>
		<?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
		</div><!-- row -->
<?php endif; ?>
<?php endforeach; ?>

<?php foreach ($this->getRelations($this->modelClass) as $relation): ?>
<?php if ($relation[1] == GxActiveRecord::HAS_MANY || $relation[1] == GxActiveRecord::MANY_MANY): ?>
		<label><?php echo '<?php'; ?> echo GxHtml::encode($model->getRelationLabel('<?php echo $relation[0]; ?>')); ?></label>
		<?php echo '<?php ' . $this->generateActiveRelationField($this->modelClass, $relation) . "; ?>\n"; ?>
<?php endif; ?>
<?php endforeach; ?>

        <div class="btn-save">
            <?php echo "<?php
            echo GxHtml::submitButton(Yii::t('viLib', 'Save'));
            \$this->endWidget();
            ?>\n"; ?>
        </div>
</div><!-- form -->