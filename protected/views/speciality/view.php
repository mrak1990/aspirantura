<?php
/**
 * @var Speciality $model
 * @var Controller $this
 */

$this->breadcrumbs = array_merge(
    $this->breadcrumbs,
    array($model->title)
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
        'code',
        'title',
        'scienceBranch' => array(
            'label' => 'Отрасль науки',
            'value' => CHtml::link($model->scienceBranch->full_title_nom, array(
                    'scienceBranch/view',
                    'id' => $model->science_branch_id
                )
            ),
            'type' => 'html',
        ),
    ),
));
?>
