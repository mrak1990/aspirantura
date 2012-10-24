<?php
$this->breadcrumbs = array_merge($this->breadcrumbs, array(
    $model->username,
));

$this->menu = array(
    array('label' => 'Все записи', 'icon' => 'list', 'url' => array('index')),
    array('label' => 'Добавить запись', 'icon' => 'plus', 'url' => array('create')),
    array('label' => 'Исправить эту запись', 'icon' => 'pencil', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Удалить эту запись', 'icon' => 'trash', 'url' => '#', 'linkOptions' => array(
        'submit' => array('delete', 'id' => $model->id),
        'confirm' => 'Вы действительно хотите удалить эту запись?'
    )),
    array('label' => 'Администрирование', 'icon' => 'cog', 'url' => array('admin')),
);
?>

<h2>Просмотр элемента</h2>

<?php
$this->widget('ext.bootstrap.widgets.BootDetailView', array(
    'data' => $model,
    'attributes' => array(
        'username',
        'password_hash',
        array(
            'label' => 'ФИО',
            'type' => 'text',
            'value' => $model->fio . ' (' . $model->fullName . ')',
        )
    ),
));
?>
