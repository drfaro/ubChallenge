<?php
$this->breadcrumbs=array(
	'Emails',
);

$this->menu=array(
	array('label'=>'Create emails', 'url'=>array('create')),
	array('label'=>'Manage emails', 'url'=>array('admin')),
);
?>

<h1>Emails</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
