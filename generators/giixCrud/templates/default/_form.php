<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
echo "<?php\n";
?>
echo GxHtml::openTag('div',array('class'=>'form'));

<?php $ajax = ($this->enable_ajax_validation) ? 'true' : 'false'; ?>
/**
* @var $form GxActiveForm
* @var $this <?php echo $this->get ?>
*/
$form = $this->beginWidget('GxActiveForm', array(
	'id' => '<?php echo $this->class2id($this->modelClass); ?>-form',
	'enableAjaxValidation' => <?php echo $ajax; ?>,
));


	echo GxHtml::openTag('p',array('class'=>'note'));
		echo Yii::t('app', 'Fields with'). ' <span class="required">*</span> '. Yii::t('app', 'are required').'.';
	echo GxHtml::closeTag('p'); //p

	echo $form->errorSummary($model);

<?php foreach ($this->tableSchema->columns as $column): ?>
<?php if (!$column->autoIncrement): ?>
	<?php echo $this->generateActiveField($this->modelClass, $column).";\r\n"; ?>
<?php endif; ?>
<?php endforeach; ?>

<?php foreach ($this->getRelations($this->modelClass) as  $relation): ?>
<?php if (($relation[1] == GxActiveRecord::HAS_MANY || $relation[1] == GxActiveRecord::MANY_MANY) && stripos($relation[0],'2')===false): ?>
	<?php echo $this->generateActiveRelationField($this->modelClass, $relation) . ";\r\n"; ?>
<?php endif; ?>
<?php endforeach; ?>


	echo GxHtml::openTag('div',array('class'=>'form-actions'));
		$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Submit'));
		$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset'));
	echo GxHtml::closeTag('div'); //div

$this->endWidget();
echo GxHtml::closeTag('div');//form