<?php
$this->breadcrumbs = array_merge($this->breadcrumbs, array(
    $model->title => array('view', 'id' => $model->id),
    'Редактирование',
));

$this->menu = array(
    array('label' => 'Поиск', 'url' => array('index'), 'icon' => 'search', 'itemOptions' => array('title' => 'Поиск и фильтрация записей')),
    array('label' => 'Добавить', 'url' => array('create'), 'icon' => 'plus', 'itemOptions' => array('title' => 'Добавление новой записи')),
    array('label' => 'Корзина', 'url' => array('trash'), 'icon' => 'trash', 'itemOptions' => array('title' => 'Просмотр записей в корзине')),
    array('label' => 'Действия', 'icon' => 'cog', 'itemOptions' => array(
        'class' => 'pull-right',
        'title' => 'Действия над записью'
    ),
        'items' => array(
            array('label' => 'В корзину', 'url' => '#', 'icon' => 'trash', 'linkOptions' => array(
                'submit' => array('toTrash', 'id' => $model->id),
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

<h2>Редактирование</h2>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>