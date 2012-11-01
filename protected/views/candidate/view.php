<?php
/**
 * @var Candidate $model
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
    )
);

$this->widget('ext.bootstrap.widgets.BootDetailView', array(
        'data' => $model,
        'attributes' => array(
            'id',
            'department_id',
            'fio',
            'birth',
            'is_postgrad',
            'whence',
            'status',
            'speciality_id',
        ),
    )
);

?>
