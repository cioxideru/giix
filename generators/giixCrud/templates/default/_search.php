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
));

<?php foreach($this->tableSchema->columns as $column): ?>
<?php
	$field = $this->generateInputField($this->modelClass, $column);
	if (strpos($field, 'password') !== false || $column->autoIncrement)
		continue;
?>
	<?php echo $this->generateSearchField($this->modelClass, $column).";\r\n"; ?>

<?php endforeach; ?>
	echo GxHtml::openTag('div',array('class'=>'form-actions'));
		$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Search'));
		$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset'));
	echo GxHtml::closeTag('div'); //div
$this->endWidget();

echo GxHtml::closeTag('div'); // form
