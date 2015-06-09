<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
echo "<?php\n";
?>
echo GxHtml::openTag('div',array('class'=>'wide form'));
/**
* @var $form GxActiveForm
* @var $this <?php echo $this->controllerClass; ?>

* @var $model <?php echo $this->modelClass; ?>

*/
$form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'GET',
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
));

<?php foreach($this->tableSchema->columns as $column): ?>
<?php
	$field = $this->generateInputField($this->modelClass, $column);
	if (strpos($field, 'password') !== false || $column->autoIncrement)
		continue;
?>
	<?php echo $this->generateSearchField($this->modelClass, $column).";\r\n"; ?>

<?php endforeach; ?>
echo TbHtml::formActions(array(
	TbHtml::submitButton('Search', array(
				'color' => TbHtml::BUTTON_COLOR_PRIMARY,
				'size'=>TbHtml::BUTTON_SIZE_DEFAULT,
			)
		),
	),array(
		'formLayout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	)
);
$this->endWidget();

echo GxHtml::closeTag('div'); // form
