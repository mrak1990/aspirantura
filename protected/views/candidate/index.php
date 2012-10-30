<?php
/**
 * @var Candidate $model
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
                        "label" => "ссылка",
                        "url" => array(
                            "#",
                            "Department[faculty_id][]" => $data->id
                        )
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
            'value' => 'CHtml::link("$data->fio", array("view", "id"=>$data->id))',
            'type' => 'html',
        ),
        'department' => array(
            'header' => 'Кафедра',
            'name' => 'title',
            'value' => 'CHtml::link("$data->department->fullTitle", array("department/view", "id"=>$data->department_id))',
            'type' => 'html',
        ),
        'advisor' => array(
            'header' => 'Научный руководитель',
            'name' => 'advisor',
            'value' => 'CHtml::link("$data->advisor->fio", array("staff/view", "id"=>$data->staff_id))',
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
            'htmlOptions' => array(
                'style' => 'width: 20px'
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
