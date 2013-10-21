<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
echo "<?php\n";
?>
$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
		array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create'),'icon'=>'plus'),
		array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('index'),'icon'=>'th-list','active'=>true),
	);

Yii::app()->clientScript->registerScript('search', "
	$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
	});
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid', {
			data: $(this).serialize()
		});
		return false;
	});
");

echo GxHtml::openTag('legend');
	echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2));
echo GxHtml::closeTag('legend');

echo GxHtml::openTag('p',array('class'=>'note'));
	echo "You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done.";
echo GxHtml::closeTag('p');

echo GxHtml::link(Yii::t('app', 'Advanced Search(click to open form)'), '#', array('class' => 'search-button'));

echo GxHtml::openTag('div',array('class'=>'search-form','style'=>'display: none;'));
	$this->renderPartial('_search', compact(array_keys(get_defined_vars())));
echo GxHtml::closeTag('div'); // search form


$this->widget('bootstrap.widgets.TbGridView', array(
	'id' => '<?php echo $this->class2id($this->modelClass); ?>-grid',
	'type'=>'striped bordered condensed',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'pager'=>array(
		'class'=>'ext.AjaxList.AjaxList',
	),
	'columns' => array(
<?php
$count = 0;
foreach ($this->tableSchema->columns as $column) {
	if ($column->autoIncrement)
		continue;
	if (++$count == 7){
		echo "\t/*\n";
	}
	echo "\t\t" . $this->generateGridViewColumn($this->modelClass, $column).",\n";
}
if ($count >= 7)
	echo "\t*/\n";
?>
		array(
			'class' => 'bootstrap.widgets.TbButtonColumn',
			'htmlOptions'=>array('style'=>'width: 50px'),
			'buttons'=>array(
				'update' => array(
					'visible' => 'true',
				),
				'delete' => array(
					'visible' => 'true',
				),
				'view' => array(
					'visible' => 'true',
				),
			),
		),
	),
)); ?>