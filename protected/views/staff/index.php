<?php

$this->breadcrumbs = array_keys($this->breadcrumbs);
$this->menu = array(
    array(
        'label' => 'Поиск',
        'url' => array('index'),
        'icon' => 'search',
        'itemOptions' => array(
            'title' => 'Поиск и фильтрация записей',
        )
    ),
    array(
        'label' => 'Добавить',
        'url' => array('create'),
        'icon' => 'plus',
        'itemOptions' => array(
            'title' => 'Добавление новой записи',
        )
    ),
    array(
        'label' => 'Корзина',
        'url' => array('trash'),
        'icon' => 'trash',
        'itemOptions' => array(
            'title' => 'Просмотр записей в корзине',
        )
    ),
    array(
        'label' => 'Параметры',
        'icon' => 'cog',
        'itemOptions' => array(
            'class' => 'pull-right',
            'title' => 'Параметры вывода',
        ),
        'items' => array(),
    )
);
?>

<?php

$this->renderPartial('_search', array(
    'model' => $provider->model,
    'searchModel' => $searchModel,
));
?>

<?php

$this->widget('MyBootGridView', array(
    'id' => 'staff-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $provider,
    'enableSorting' => false,
    'columns' => array(
        'checbox' => array(
            'class' => 'CCheckBoxColumn',
            'id' => 'checkboxes',
            'selectableRows' => 2,
        ),
        'id',
        'fio' => array(
            'header' => 'ФИО',
            'name' => 'fio',
            'value' => 'CHtml::link($data->fio, array("view", "id"=>$data->id))',
            'type' => 'html',
        ),
        'department' => array(
            'header' => 'Кафедра',
            'name' => 'department',
            'value' => 'CHtml::link($data->department->fullTitle, array("department/view", "id"=>$data->department->id))',
            'type' => 'html',
        ),
        'faculty' => array(
            'header' => 'Факультет',
            'name' => 'faculty',
            'value' => 'CHtml::link($data->department->faculty->fullTitle, array("faculty/view", "id"=>$data->department->faculty->id))',
            'type' => 'html',
        ),
    ),
    'footer' => array(
        'prepend' => 'С отмеченными: ',
        'class' => 'action-footer',
        'items' => array(
            array(
                'value' => CHtml::ajaxLink('В корзину', array('toTrash', 'id' => 'many'), array(
                        'type' => 'POST',
                        'data' => 'js:{ids : $.fn.yiiGridView.getChecked("staff-grid", "checkboxes")}',
                        'success' => '$.fn.yiiGridView.update("staff-grid")',
                        'error' => 'function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}',
                    )
                ),
                'visible' => $this->action->id === 'index',
            ),
            array(
                'value' => CHtml::ajaxLink('Восстановить', array('restore', 'id' => 'many'), array(
                        'type' => 'POST',
                        'data' => 'js:{ids : $.fn.yiiGridView.getChecked("staff-grid", "checkboxes")}',
                        'success' => '$.fn.yiiGridView.update("staff-grid")',
                        'error' => 'function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}',
                    )
                ),
                'visible' => $this->action->id === 'trash',
            ),
            array(
                'value' => CHtml::ajaxLink('Удалить', array('delete', 'id' => 'many'), array(
                        'type' => 'POST',
                        'data' => 'js:{ids : $.fn.yiiGridView.getChecked("staff-grid", "checkboxes")}',
                        'success' => '$.fn.yiiGridView.update("staff-grid")',
                        'error' => 'function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}',
                    ), array(
                        'confirm' => 'Вы действительно хотите везвозвратно удалить отмеченные записи?',
                    )
                ),
                'visible' => $this->action->id === 'trash',
            ),
        ),
    ),
));
?>
