<?php
$this->breadcrumbs = array_merge($breadcrumbsInit, array(
    $model->name => array('view', 'name' => $model->name),
    'Правка',
));

$this->menu = array(
    array('label' => 'Все записи', 'icon' => 'list', 'url' => array('index')),
    array('label' => 'Добавить запись', 'icon' => 'plus', 'url' => array('create')),
    array('label' => 'Просмотреть эту запись', 'icon' => 'eye-open', 'url' => array(
        'view',
        'name' => $model->name
    )),
    array('label' => 'Администрирование', 'icon' => 'cog', 'url' => array('admin')),
);
?>

<h2>Правка</h2>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>