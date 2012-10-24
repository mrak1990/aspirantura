<?php

$this->breadcrumbs = array_keys($this->breadcrumbs);
$this->menu = array(
    array('label' => 'Поиск', 'url' => array('index'), 'icon' => 'search', 'itemOptions' => array('title' => 'Поиск и фильтрация записей')),
    array('label' => 'Добавить', 'url' => array('create'), 'icon' => 'plus', 'itemOptions' => array('title' => 'Добавление новой записи')),
    array('label' => 'Корзина', 'url' => array('trash'), 'icon' => 'trash', 'itemOptions' => array('title' => 'Просмотр записей в корзине')),
    array('label' => 'Параметры', 'icon' => 'cog', 'itemOptions' => array(
        'class' => 'pull-right',
        'title' => 'Параметры вывода'
    ),
        'items' => array(),
    ));
?>

<?php $this->widget('MyBootGridView', array(
    'id' => 'scientific-degree-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => new CActiveDataProvider($model, array(
        'pagination' => array(
            'pageSize' => 5,
        ),
    )),
    'enableSorting' => false,
    'columns' => array(
        'checbox' => array(
            'class' => 'CCheckBoxColumn',
            'id' => 'checkboxes',
            'selectableRows' => 2,
        ),
        'id',
        'title' => array(
            'header' => 'Аббревиатура',
            'name' => 'title',
            'value' => 'CHtml::link($data->title, array("view", "id"=>$data->id))',
            'type' => 'html',
        ),
        'full_title' => array(
            'header' => 'Название',
            'name' => 'full_title',
            'value' => 'CHtml::link($data->full_title, array("view", "id"=>$data->id))',
            'type' => 'html',
        ),
    ),
    'footer' => array(
        'prepend' => 'С отмеченными: ',
        'class' => 'action-footer',
        'items' => array(
            array(
                'value' => CHtml::ajaxLink('Удалить', array('delete', 'id' => 'many'), array(
                        'type' => 'POST',
                        'data' => 'js:{ids : $.fn.yiiGridView.getChecked("faculty-grid", "checkboxes")}',
                        'success' => 'js:$.fn.yiiGridView.update("faculty-grid")',
                        'error' => 'js:function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}',
                    ), array(
                        'confirm' => 'Вы действительно хотите везвозвратно удалить отмеченные записи?',
                    )
                ),
                'visible' => $this->action->id === 'trash',
            ),
        ),
    ),
)); ?>
