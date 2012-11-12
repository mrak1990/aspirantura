<?php
/**
 * @var Staff $model
 * @var SortForm $searchModel
 * @var CDbCriteria $criteria
 * @var CSort $sort
 * @var Controller $this
 */

$this->breadcrumbs = array_keys($this->breadcrumbs);
$this->menu = HelperHTML::getMenu(basename(__FILE__, '.php'));

$this->renderPartial('_search', array(
    'model' => $model,
    'searchModel' => $searchModel,
));

$this->widget('MyBootGridView', array(
    'id' => 'staff-grid',
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
            'name' => 'fio',
            'value' => 'CHtml::link($data->fio, array("view", "id"=>$data->id))',
            'type' => 'html',
        ),
        'department' => array(
            'header' => 'Кафедра',
            'name' => 'department',
            'value' => 'CHtml::link($data->department->fullTitle, array("department/view", "id"=>$data->department->id))',
            'type' => 'html',
        ),
        'faculty' => array(
            'header' => 'Факультет',
            'name' => 'faculty',
            'value' => 'CHtml::link($data->department->faculty->fullTitle, array("faculty/view", "id"=>$data->department->faculty->id))',
            'type' => 'html',
        ),
        'candidates' => array(
            'header' => 'Аспирантов',
            'value' => 'count($data->candidates1)',
        ),
        array(
            'class' => 'ext.bootstrap.widgets.BootButtonColumn',
            'htmlOptions' => array('style' => 'width: 50px'),
        ),
        array(
            'class' => 'CDataColumn',
            'type' => 'raw',
            'value' => Staff::getSubModelMenuFunction('mini'),
            'htmlOptions' => array('style' => 'width: 37px'),
        ),
    ),
    'footer' => array(
        'prepend' => 'С отмеченными: ',
        'class' => 'action-footer',
        'items' => $model->getFooterItems(),
    ),
));
?>
