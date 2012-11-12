<?php
/**
 * @var ThesisBoard $model
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
    'id' => 'thesis-board-grid',
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
        'code' => array(
            'header' => 'Код',
            'name' => 'code',
            'value' => 'CHtml::link($data->code, array("view", "id"=>$data->id))',
            'type' => 'html',
        ),
        'head' => array(
            'header' => 'Председатель',
            'name' => 'head',
            'value' => 'CHtml::link($data->staff1->fio, array("view", "id"=>$data->staff_id))',
            'type' => 'html',
        ),
        'membersCount',
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
