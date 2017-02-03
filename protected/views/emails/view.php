<?php
$this->breadcrumbs=array(
	'Emails'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List emails', 'url'=>array('index')),
	array('label'=>'Create emails', 'url'=>array('create')),
	array('label'=>'Update emails', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete emails', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>'Manage emails', 'url'=>array('admin')),
);
?>

<h1>View emails #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'email',
	),
)); ?>
