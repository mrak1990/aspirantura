<?php
/**
 * @var Candidate $model
 * @var SortForm $searchModel
 * @var CDbCriteria $criteria
 * @var CSort $sort
 * @var Controller $this
 */

$this->breadcrumbs = array_keys($this->breadcrumbs);
$this->menu = HelperHTML::getMenu(basename(__FILE__, '.php'), new Candidate());

$this->renderPartial('_search', array(
    'model' => $model,
    'searchModel' => $searchModel,
));

$this->widget('MyBootGridView', array(
    'id' => 'candidate-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => new CActiveDataProvider($model, array(
        'criteria' => $criteria,
        'sort' => $sort,
        'pagination' => array( //            'pageSize' => 5,
        ),
    )),
    'enableSorting' => false,
    'columns' => array(
        'checbox' => array(
            'class' => 'CCheckBoxColumn',
            'id' => 'checkboxes',
            'selectableRows' => 2,
        ),
        'id',
        'fio' => array(
            'header' => 'ФИО',
            'name' => 'title',
            'value' => 'CHtml::link($data->fio, array("view", "id"=>$data->id))',
            'type' => 'html',
        ),
        'doctorLong',
        'enter_date',
        'done_date' => array(
            'name' => 'done_date',
            'value' => '$data->done_date ? $data->done_date : "Не окончил"',
            'type' => 'html',
        ),
        'department' => array(
            'header' => 'Кафедра',
            'name' => 'title',
            'value' => 'CHtml::link($data->department->fullTitle, array("department/view", "id"=>$data->department_id))',
            'type' => 'html',
        ),
        'advisor' => array(
            'header' => 'Научный руководитель',
            'name' => 'advisor',
            'value' => 'CHtml::link($data->advisor->fio, array("staff/view", "id"=>$data->staff_id))',
            'type' => 'html',
        ),
        'disser' => array(
            'header' => 'Диссертационная работа',
            'name' => 'disser',
            'value' => '$data->disser->shortTitle',
        ),
        array(
            'class' => 'ext.bootstrap.widgets.BootButtonColumn',
            'htmlOptions' => array(
                'style' => 'width: 50px'
            ),
        ),
    ),
    'footer' => array(
        'prepend' => 'С отмеченными: ',
        'class' => 'action-footer',
        'items' => $model->getFooterItems(),
    ),
));

?>
