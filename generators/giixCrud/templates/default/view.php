<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n
\$this->breadcrumbs = array(
	\$model->label(2) => array('index'),
	GxHtml::valueEx(\$model),
);\n";
?>

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create'),'icon'=>'plus'),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'icon'=>'pencil', 'url'=>array('update',  'id' => $model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'icon'=>'remove', 'linkOptions' => array('submit' => array('delete', 'id' => $model-><?php echo $this->tableSchema->primaryKey; ?>), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('index'),'icon'=>'th-list'),
);

echo GxHtml::openTag('legend').Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)).GxHtml::closeTag('legend');

$this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'type'=>'striped bordered condensed',
	'attributes' => array(
<?php
foreach ($this->tableSchema->columns as $column)
	if(!$column->autoIncrement)
		echo "\t\t".$this->generateDetailViewAttribute($this->modelClass, $column) . ",\n";
?>
	),
));

<?php foreach (GxActiveRecord::model($this->modelClass)->relations() as $relationName => $relation): ?>
<?php if (($relation[0] == GxActiveRecord::HAS_MANY || $relation[0] == GxActiveRecord::MANY_MANY) && stripos($relationName,'2')===false): ?>
echo GxHtml::openTag('h2').GxHtml::encode($model->getRelationLabel('<?php echo $relationName; ?>')).GxHtml::closeTag('h2');
	echo GxHtml::openTag('ul');
	foreach($model-><?php echo $relationName; ?> as $relatedModel) {
		echo GxHtml::openTag('li');
			echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('<?php echo strtolower($relation[1][0]) . substr($relation[1], 1); ?>/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
<?php endif; ?>
<?php endforeach; ?>