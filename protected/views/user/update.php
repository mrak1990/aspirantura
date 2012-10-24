<?php
$this->breadcrumbs = array_merge($this->breadcrumbs, array(
    $model->username => array('view', 'id' => $model->username),
    'Правка',
));

$this->menu = array(
    array('label' => 'Все записи', 'icon' => 'list', 'url' => array('index')),
    array('label' => 'Добавить запись', 'icon' => 'plus', 'url' => array('create')),
    array('label' => 'Просмотреть эту запись', 'icon' => 'eye-open', 'url' => array(
        'view', 'id' => $model->id)),
    array('label' => 'Администрирование', 'icon' => 'cog', 'url' => array('admin')),
);
?>

<h2>Правка</h2>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>