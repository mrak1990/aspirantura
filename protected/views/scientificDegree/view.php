<?php
$this->breadcrumbs = array_merge($this->breadcrumbs, array(
    $model->title,
));

$this->menu = array(
    array('label' => 'Поиск', 'url' => array('index'), 'icon' => 'search', 'itemOptions' => array('title' => 'Поиск и фильтрация записей')),
    array('label' => 'Добавить', 'url' => array('create'), 'icon' => 'plus', 'itemOptions' => array('title' => 'Добавление новой записи')),
    array('label' => 'Действия', 'icon' => 'cog', 'itemOptions' => array(
        'class' => 'pull-right',
        'title' => 'Действия над записью'
    ),
        'items' => array(
            array('label' => 'Удалить', 'url' => '#', 'icon' => 'remove', 'linkOptions' => array(
                'submit' => array('delete', 'id' => $model->id),
                'confirm' => 'Вы действительно хотите безвозвратно удалить эту запись?',
            ),
            ),
        ),
    ),
    array('label' => 'Редактирование', 'url' => array('update', 'id' => $model->id), 'icon' => 'edit', 'itemOptions' => array(
        'class' => 'pull-right',
        'title' => 'Редактирование записи'
    )),
    array('label' => 'Просмотр', 'url' => array('view', 'id' => $model->id), 'icon' => 'th-list', 'itemOptions' => array(
        'class' => 'pull-right',
        'title' => 'Простотр записи'
    )),
);
?>

<h2>Просмотр записи</h2>

<?php $this->widget('ext.bootstrap.widgets.BootDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'title',
        'full_title',
    ),
)); ?>
