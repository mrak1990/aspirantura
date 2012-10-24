<?php
$this->breadcrumbs = array_merge($breadcrumbsInit, array(
    'Добавление',
));

$this->menu = array(
    array('label' => 'Все записи', 'icon' => 'list', 'url' => array('index')),
    array('label' => 'Администрирование', 'icon' => 'cog', 'url' => array('admin')),
);
?>

<h2>Добавление</h2>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>