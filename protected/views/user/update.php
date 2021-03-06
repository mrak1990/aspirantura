<?php
/**
 * @var User $model
 * @var Controller $this
 */

$this->breadcrumbs = array_merge(
    $this->breadcrumbs,
    array(
        "{$model->username} ({$model->fio})" => array(
            'view',
            'id' => $model->id
        ),
        'Редактирование',
    )
);

$this->menu = HelperHTML::getMenu(basename(__FILE__, '.php'), $model);

echo $this->renderPartial('_info', array(
        'model' => $model,
        'title' => 'Редактирование учётной записи',
    )
);

echo $this->renderPartial('_form', array(
    'model' => $model
));
?>