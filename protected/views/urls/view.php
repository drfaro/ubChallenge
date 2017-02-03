<?php
$this->breadcrumbs=array(
	'Urls'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List urls', 'url'=>array('index')),
	array('label'=>'Create urls', 'url'=>array('create')),
	array('label'=>'Update urls', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete urls', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('zii','Are you sure you want to delete this item?'))),
	array('label'=>'Manage urls', 'url'=>array('admin')),
);
?>

<h1>View urls #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'url',
		'visited',
	),
)); ?>
