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
        'department' => array(
            'label' => 'Кафедра',
            'value' => CHtml::link($model->department->fullTitle, array(
                'department/view',
                'id' => $model->department_id
            )),
            'type' => 'html',
        ),
        'birth',
        'is_postgrad',
        'speciality' => array(
            'label' => 'Специальность',
            'value' => CHtml::link($model->speciality->fullTitle, array(
                'speciality/view',
                'id' => $model->speciality_id
            )),
            'type' => 'html',

        )
    ),
));

?>
