<?php
$this->breadcrumbs = $breadcrumbsInit;

$this->menu = array(
    array('label' => 'Добавить запись', 'icon' => 'plus', 'url' => array('create')),
    array('label' => 'Администрирование', 'icon' => 'cog', 'url' => array('admin')),
);
?>

<h2>Список всех элементов</h2>

<?php
$this->widget('bootstrap.widgets.BootGridView', array(
    'dataProvider' => $dataProvider,
    'template' => "{items}",
    'itemsCssClass' => 'table table-striped table-bordered table-condensed',
    'columns' => array(
        'name:text:Название',
        'longType:text:Тип',
        'description:text:Описание',
//        array('name' => 'description', 'header' => 'Описание'),
        array(
            'class' => 'bootstrap.widgets.BootButtonColumn',
            'viewButtonUrl' => 'Yii::app()->controller->createUrl("view",array("name"=>$data->primaryKey))',
            'updateButtonUrl' => 'Yii::app()->controller->createUrl("update",array("name"=>$data->primaryKey))',
            'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete",array("name"=>$data->primaryKey))',
            'htmlOptions' => array('style' => 'width: 50px'),
        ),
    ),
));
?>
