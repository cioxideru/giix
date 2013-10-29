<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass; ?> {

<?php 
	$authpath = 'giix.generators.giixCrud.templates.default.auth.';
	Yii::app()->controller->renderPartial($authpath . $this->authtype);
?>

	public function actionView($id) {
		$model = $this->loadModel($id, '<?php echo $this->modelClass; ?>');
		$this->render('view', compact('model'));
	}

	public function actionCreate() {
		/**
		* @var $model <?php echo $this->modelClass; ?>

		*/
		$model = new <?php echo $this->modelClass; ?>;
		$data = $this->getPost('<?php echo $this->modelClass; ?>');

<?php if ($this->enable_ajax_validation): ?>
		$this->performAjaxValidation($model, '<?php echo $this->class2id($this->modelClass)?>-form');
<?php endif; ?>

		if (Yii::app()->request->getIsPostRequest() && $data !== null) {
			$model->setAttributes($data);
<?php if ($this->hasManyManyRelation($this->modelClass)): ?>
			$relatedData = <?php echo $this->generateGetPostRelatedData($this->modelClass, 4); ?>;
<?php endif; ?>

<?php if ($this->hasManyManyRelation($this->modelClass)): ?>
			if ($model->saveWithRelated($relatedData)) {
<?php else: ?>
			if ($model->save()) {
<?php endif; ?>
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model-><?php echo $this->tableSchema->primaryKey; ?>));
			}
		}

		$this->render('create', compact( 'model'));
	}

	public function actionUpdate($id) {
		/**
		* @var $model <?php echo $this->modelClass; ?>

		*/
		$model = $this->loadModel($id, '<?php echo $this->modelClass; ?>');
		$data = $this->getPost('<?php echo $this->modelClass; ?>');

<?php if ($this->enable_ajax_validation): ?>
		$this->performAjaxValidation($model, '<?php echo $this->class2id($this->modelClass)?>-form');
<?php endif; ?>

		if (Yii::app()->request->getIsPostRequest() && $data !== null) {
			$model->setAttributes($data);
<?php if ($this->hasManyManyRelation($this->modelClass)): ?>
			$relatedData = <?php echo $this->generateGetPostRelatedData($this->modelClass, 4); ?>;
<?php endif; ?>

<?php if ($this->hasManyManyRelation($this->modelClass)): ?>
			if ($model->saveWithRelated($relatedData)) {
<?php else: ?>
			if ($model->save()) {
<?php endif; ?>
				$this->redirect(array('update', 'id' => $model-><?php echo $this->tableSchema->primaryKey; ?>));
			}
		}

		$this->render('update',compact( 'model'));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			try{
				$this->loadModel($id, '<?php echo $this->modelClass; ?>')->delete();
			}catch(Exception $ex)
			{
				if(YII_DEBUG)
					throw $ex;

				throw new CHttpException(404, Yii::t('app', 'You need to delete related data.'));
				Yii::app()->end();
			}

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('index'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		/**
		* @var $model <?php echo $this->modelClass; ?>

		*/
		$model = new <?php echo $this->modelClass; ?>('search');
		$model->unsetAttributes();

		if ($this->getParam('<?php echo $this->modelClass; ?>')!== null)
			$model->setAttributes($this->getParam('<?php echo $this->modelClass; ?>'));

		$this->render('admin', compact( 'model'));
	}

}