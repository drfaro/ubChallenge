<?php
$this->breadcrumbs=array(
	'Emails'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List emails', 'url'=>array('index')),
	array('label'=>'Create emails', 'url'=>array('create')),
	array('label'=>'View emails', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage emails', 'url'=>array('admin')),
);
?>

<h1>Update emails <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>