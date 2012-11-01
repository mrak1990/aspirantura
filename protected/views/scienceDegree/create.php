<?php
$this->breadcrumbs = array_merge($this->breadcrumbs, array(
    'Добавление',
));

$this->menu = array(
    array('label' => 'Поиск', 'url' => array('index'), 'icon' => 'search', 'itemOptions' => array('title' => 'Поиск и фильтрация записей')),
    array('label' => 'Добавить', 'url' => array('create'), 'icon' => 'plus', 'itemOptions' => array('title' => 'Добавление новой записи')),
    array('label' => 'Корзина', 'url' => array('trash'), 'icon' => 'trash', 'itemOptions' => array('title' => 'Просмотр записей в корзине')),
);
?>

<h2>Добавление</h2>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>