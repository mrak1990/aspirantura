<?php
/**
 * @var AuthItem $model
 * @var Controller $this
 */

$this->breadcrumbs = array_merge(
    $this->breadcrumbs,
    array(
        $model->name => array(
            'view',
            'name' => $model->name
        ),
        'Редактирование',
    )
);

$this->menu = HelperHTML::getMenu(basename(__FILE__, '.php'), $model, 'name');

echo $this->renderPartial('_info', array(
        'model' => $model,
        'title' => 'Редактирование записи',
    )
);

echo $this->renderPartial('_form', array('model' => $model));
?>