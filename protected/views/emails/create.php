<?php
$this->breadcrumbs=array(
	'Emails'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List emails', 'url'=>array('index')),
	array('label'=>'Manage emails', 'url'=>array('admin')),
);
?>

<h1>Create emails</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>