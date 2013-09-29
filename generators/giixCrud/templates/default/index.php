<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
echo "<?php\n";
?>

$this->breadcrumbs = array(
	<?php echo $this->modelClass; ?>::label(2),
	Yii::t('app', 'Index'),
);


$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . <?php echo $this->modelClass; ?>::label(), 'url' => array('create'),'icon'=>'plus'),
	array('label'=>Yii::t('app', 'Manage') . ' ' . <?php echo $this->modelClass; ?>::label(2), 'url' => array('index'),'icon'=>'list'),
);

echo GxHtml::openTag('legend');
	echo GxHtml::encode(<?php echo $this->modelClass; ?>::label(2));
echo GxHtml::closeTag('legend');

$this->widget('bootstrap.widgets.TbListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
	)
);