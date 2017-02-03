<?php
$this->breadcrumbs=array(
	'Urls'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List urls', 'url'=>array('index')),
	array('label'=>'Manage urls', 'url'=>array('admin')),
);
?>

<h1>Create urls</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>