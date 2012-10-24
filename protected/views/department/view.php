<?php
/**
 * @var Department $model
 * @var Controller $this
 */

$this->breadcrumbs = array_merge(
    $this->breadcrumbs,
    array(
        $model->title,
    )
);
$this->menu = HelperHTML::getMenu(basename(__FILE__, '.php'), $model);

$this->renderPartial('_info', array(
        'model' => $model,
        'title' => 'Просмотр записи',
    )
);

$this->widget('ext.bootstrap.widgets.BootDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'title',
        'number',
        'faculty' => array(
            'label' => 'Факультет',
            'value' => CHtml::link($model->faculty->fullTitle, array('faculty/view', 'id' => $model->faculty_id)),
            'type' => 'html',
        ),
        'head' => array(
            'label' => 'Заведующий',
            'value' => isset($model->head) ? CHtml::link($model->head->fio, array(
                'staff/view', 'id' => $model->staff_id
            )) : null,
            'type' => 'html',
        ),
    ),
));
?>
