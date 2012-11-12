<?php
/**
 * @var Candidate $model
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
        'doctorLong',
        'enter',
        'done_date' => array(
            'name' => 'done_date',
            'value' => $model->done_date
                ? $model->done_date
                : "Не окончил",
        ),
        'department' => array(
            'name' => 'department_id',
            'value' => CHtml::link($model->department->fullTitle, array(
                'department/view',
                'id' => $model->department_id
            )),
            'type' => 'html',
        ),
        'advisor' => array(
            'name' => 'staff_id',
            'value' => CHtml::link($model->advisor->fio, array(
                'staff/view',
                'id' => $model->staff_id
            )),
            'type' => 'html',
        ),
        'disser' => array(
            'name' => 'disserTitle',
            'value' => $model->disser->shortTitle,
        ),
        'birth',
        'speciality' => array(
            'name' => 'speciality_id',
            'value' => CHtml::link($model->speciality->fullTitle, array(
                'speciality/view',
                'id' => $model->speciality_id
            )),
            'type' => 'html',

        )
    ),
));

?>
