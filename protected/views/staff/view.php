<?php
/**
 * @var Staff $model
 * @var Controller $this
 */

$this->breadcrumbs = array_merge(
    $this->breadcrumbs,
    array($model->fio)
);

$this->menu = HelperHTML::getMenu(basename(__FILE__, '.php'), $model);

$this->renderPartial('_info', array(
    'model' => $model,
    'title' => 'Просмотр записи',
));

$this->widget('ext.bootstrap.widgets.BootDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'fio',
        'degree' => array(
            'label' => 'Учёная степень',
            'value' => $model->getScienceDegreesAsString(),
            'type' => 'html',
        ),
        'department' => array(
            'label' => 'Кафедра',
            'value' => CHtml::link($model->department->fullTitle, array(
                'department/view',
                'id' => $model->department_id
            )),
            'type' => 'html',
        ),
        'birth',
    ),
));
?>
