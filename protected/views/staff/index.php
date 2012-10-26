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

$valueFunction = function ($data)
{
    return Yii::app()->controller->widget("ext.bootstrap.widgets.BootButtonGroup", array(
        "size" => "mini",
        "buttons" => array(
            array(
                "items" => array(
                    array(
                        "label" => "аспиранты",
                        "url" => "#"
                    ),
                    "---",
                    array(
                        "label" => "что-то ещё",
                        "url" => "#"
                    ),
                )
            ),
        ),
    ), true);
};

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
        array(
            'class' => 'ext.bootstrap.widgets.BootButtonColumn',
            'htmlOptions' => array('style' => 'width: 50px'),
        ),
        array(
            'class' => 'CDataColumn',
            'type' => 'raw',
            'value' => $valueFunction,
            'htmlOptions' => array('style' => 'width: 20px'),
        ),
    ),
    'footer' => array(
        'prepend' => 'С отмеченными: ',
        'class' => 'action-footer',
        'items' => $model->getFooterItems(),
    ),
));
?>
