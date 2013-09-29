<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
echo "<?php\n";
?>
$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model) => array('view', 'id' => GxActiveRecord::extractPkValue($model, true)),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create'),'icon'=>'plus'),
	array('label' => Yii::t('app', 'View') . ' ' . $model->label(), 'icon'=>'eye-open', 'url'=>array('view', 'id' => GxActiveRecord::extractPkValue($model, true))),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('index'),'icon'=>'th-list'),
);

echo GxHtml::openTag('legend');
	echo Yii::t('app', 'Update') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model));
echo GxHtml::closeTag('legend');


$this->renderPartial('_form', array(
		'model' => $model
	)
);
