<?php
/**
 * @var Department $model
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
    'id' => 'department-grid',
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
        'title' => array(
            'header' => 'Название',
            'name' => 'title',
            'value' => 'CHtml::link($data->fullTitle, array("view", "id"=>$data->id))',
            'type' => 'html',
        ),
        'faculty' => array(
            'header' => 'Факультет',
            'name' => 'faculty',
            'value' => 'CHtml::link($data->faculty->fullTitle, array("faculty/view", "id"=>$data->faculty->id))',
            'type' => 'html',
        ),
        array(
            'header' => 'Заведующий',
            'name' => 'head',
            'value' => 'isset($data->head) ? CHtml::link($data->head->fio, array("staff/view", "id"=>$data->staff_id)) : null',
            'type' => 'html',
        ),
        array(
            'class' => 'ext.bootstrap.widgets.BootButtonColumn',
            'htmlOptions' => array('style' => 'width: 50px'),
        ),
        array(
            'class' => 'CDataColumn',
            'type' => 'raw',
            'value' => Department::getSubModelMenuFunction('mini'),
            'htmlOptions' => array(
                'style' => 'width: 37px'
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

