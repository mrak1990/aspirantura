<?php
/**
 * @var User $model
 * @var SortForm $searchModel
 * @var CDbCriteria $criteria
 * @var CSort $sort
 * @var Controller $this
 */

$this->breadcrumbs = array_keys($this->breadcrumbs);
$this->menu = HelperHTML::getMenu(basename(__FILE__, '.php'), new User());

$this->renderPartial('_search', array(
    'model' => $model,
    'searchModel' => $searchModel,
));

$this->widget('MyBootGridView', array(
    'id' => 'user-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => new CActiveDataProvider($model, array(
        'criteria' => $criteria,
        'sort' => $sort,
        'pagination' => array(),
    )),
    'enableSorting' => false,
    'columns' => array(
        'checbox' => array(
            'class' => 'CCheckBoxColumn',
            'id' => 'checkboxes',
            'selectableRows' => 2,
        ),
        'id',
        'username' => array(
            'header' => 'Логин',
            'name' => 'username',
            'value' => 'CHtml::link("$data->username", array("view", "id"=>$data->id))',
            'type' => 'html',
        ),
        'fio' => array(
            'header' => 'ФИО',
            'name' => 'fio',
            'value' => 'CHtml::link("$data->fio", array("view", "id"=>$data->id))',
            'type' => 'html',
        ),
        'email' => array(
            'header' => 'Электронная почта',
            'name' => 'email',
            'value' => 'CHtml::mailto($data->email)',
            'type' => 'html',
        ),
        array(
            'class' => 'ext.bootstrap.widgets.BootButtonColumn',
            'htmlOptions' => array('style' => 'width: 50px'),
        ),
        array(
            'class' => 'CDataColumn',
            'type' => 'raw',
            'value' => User::getSubModelMenuFunction('mini'),
//            'value' => '',
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

