<?php
$this->breadcrumbs=array(
	'Urls',
);

$this->menu=array(
	array('label'=>'Create urls', 'url'=>array('create')),
	array('label'=>'Manage urls', 'url'=>array('admin')),
);
?>

<h1>Urls</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
