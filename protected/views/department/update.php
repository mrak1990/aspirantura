<?php
/**
 * @var Department $model
 * @var Controller $this
 */

$this->breadcrumbs = array_merge(
    $this->breadcrumbs,
    array(
        $model->title => array(
            'view',
            'id' => $model->id
        ),
        'Редактирование',
    )
);

$this->menu = HelperHTML::getMenu(basename(__FILE__, '.php'), $model);

echo $this->renderPartial('_info', array(
        'model' => $model,
        'title' => 'Редактирование записи',
    )
);

echo $this->renderPartial('_form', array('model' => $model));
?>