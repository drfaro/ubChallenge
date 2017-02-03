<?php
$this->breadcrumbs=array(
	'Urls'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List urls', 'url'=>array('index')),
	array('label'=>'Create urls', 'url'=>array('create')),
	array('label'=>'View urls', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage urls', 'url'=>array('admin')),
);
?>

<h1>Update urls <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>