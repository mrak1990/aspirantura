<?php
/**
 * @var User $model
 * @var Controller $this
 */

$this->breadcrumbs = array_merge(
    $this->breadcrumbs,
    array("{$model->username} ({$model->fio})")
);
$this->menu = HelperHTML::getMenu(basename(__FILE__, '.php'), $model);

//$this->renderPartial('_info', array(
//    'model' => $model,
//    'title' => 'Просмотр записи',
//));

$this->widget('ext.bootstrap.widgets.BootDetailView', array(
        'data' => $model,
        'attributes' => array(
            'id',
            'username',
            'first_name',
            'middle_name',
            'last_name',
            'email',
        ),
    )
);
?>
