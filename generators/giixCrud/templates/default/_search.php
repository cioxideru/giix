<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
echo "<?php\n";
?>
echo GxHtml::openTag('div',array('class'=>'wide form'));

$form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
));

<?php foreach($this->tableSchema->columns as $column): ?>
<?php
	$field = $this->generateInputField($this->modelClass, $column);
	if (strpos($field, 'password') !== false)
		continue;
?>
	echo GxHtml::openTag('div',array('class'=>'row'));
		<?php echo $this->generateSearchField($this->modelClass, $column).";\r\n"; ?>
	echo GxHtml::closeTag('div');

<?php endforeach; ?>
	echo GxHtml::openTag('div',array('class'=>'row buttons'));
		echo GxHtml::submitButton(Yii::t('app', 'Search'));
	echo GxHtml::closeTag('div');
$this->endWidget();

echo GxHtml::closeTag('div'); // form
