<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
echo "<?php\n";
?>

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Create'),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create'),'icon'=>'plus','active'=>true),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('index'),'icon'=>'th-list'),
);

echo GxHtml::openTag('legend');
	echo Yii::t('app', 'Create') . ' ' . GxHtml::encode($model->label());
	echo TbHtml::small(TbHtml::i(Yii::t('app', 'Fields with'). ' <span class="required">*</span> '. Yii::t('app', 'are required').'.'),array(
			'pull' => TbHtml::PULL_RIGHT,
		)
	);
echo GxHtml::closeTag('legend');

$this->renderPartial('_form', compact(array_keys(get_defined_vars())));
