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
* @var $this <?php echo $this->controllerClass; ?>

* @var $model <?php echo $this->modelClass; ?>

*/
$form = $this->beginWidget('GxActiveForm', array(
		'id' => '<?php echo $this->class2id($this->modelClass); ?>-form',
		'enableAjaxValidation' => <?php echo $ajax; ?>,
		'layout' => <?php
			if($this->form_inline==='horizontal')
				echo 'TbHtml::FORM_LAYOUT_HORIZONTAL';
			elseif($this->form_inline==='vertical')
				echo 'TbHtml::FORM_LAYOUT_VERTICAL';
			elseif($this->form_inline==='inline')
				echo 'TbHtml::FORM_LAYOUT_INLINE';
			elseif($this->form_inline==='search')
				echo 'TbHtml::FORM_LAYOUT_SEARCH';
		?>,
		'helpType' => <?php
			if($this->form_inline==='vertical')
				echo 'TbHtml::HELP_TYPE_BLOCK';
			else
				echo 'TbHtml::HELP_TYPE_INLINE';
		?>,
	)
);

	echo TbHtml::Lead(Yii::t('app', 'Fields with'). ' <span class="required">*</span> '. Yii::t('app', 'are required').'.');
	echo $form->errorSummary($model);

<?php
foreach ($this->tableSchema->columns as $column){
	if (!$column->autoIncrement){
		echo $this->generateActiveField($this->modelClass, $column).";\r\n";
	}
}
?>

<?php foreach ($this->getRelations($this->modelClass) as  $relation): ?>
<?php if (($relation[1] == GxActiveRecord::HAS_MANY || $relation[1] == GxActiveRecord::MANY_MANY) && stripos($relation[0],'2')===false): ?>
	<?php echo $this->generateActiveRelationField($this->modelClass, $relation) . ";\r\n"; ?>
<?php endif; ?>
<?php endforeach; ?>

	echo TbHtml::formActions(array(
		TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
				'color' => TbHtml::BUTTON_COLOR_PRIMARY,
				'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
			)
		),
		TbHtml::resetButton('Reset'),
	));

$this->endWidget();
echo GxHtml::closeTag('div');//form