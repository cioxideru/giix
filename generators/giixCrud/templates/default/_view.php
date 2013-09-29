<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
echo "<?php\n";
?>
echo GxHtml::openTag('div',array('class'=>'view'));

	echo GxHtml::encode($data->getAttributeLabel('<?php echo $this->tableSchema->primaryKey; ?>'));
	echo GxHtml::link(GxHtml::encode($data-><?php echo $this->tableSchema->primaryKey; ?>), array('view', 'id' => $data-><?php echo $this->tableSchema->primaryKey; ?>));

<?php
$count=0;
foreach ($this->tableSchema->columns as $column):
	if ($column->isPrimaryKey)
		continue;
?>
	echo GxHtml::encode($data->getAttributeLabel('<?php echo $column->name; ?>'));
<?php if (!$column->isForeignKey): ?>
	echo GxHtml::encode($data-><?php echo $column->name; ?>);
<?php else: ?>
	<?php
	$relations = $this->findRelation($this->modelClass, $column);
	$relationName = $relations[0];
	?>
	echo GxHtml::encode(GxHtml::valueEx($data-><?php echo $relationName; ?>));
<?php endif; ?>

<?php endforeach; ?>

echo GxHtml::closeTag('div');//view