<?php
/**
 * @var Speciality $model
 * @var SortForm $searchModel
 * @var CDbCriteria $criteria
 * @var CSort $sort
 * @var Controller $this
 */

$this->breadcrumbs = array_keys($this->breadcrumbs);
$this->menu = HelperHTML::getMenu(basename(__FILE__, '.php'), new Speciality());

$this->renderPartial('_search', array(
    'model' => $model,
    'searchModel' => $searchModel,
));

$this->widget('MyBootGridView', array(
    'id' => 'speciality-grid',
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
            'header' => 'Шифр',
            'name' => 'title',
            'value' => 'CHtml::link("$data->code", array("view", "id"=>$data->id))',
            'type' => 'html',
        ),
        array(
            'header' => 'Название',
            'name' => 'dean',
            'value' => 'CHtml::link("$data->title", array("view", "id"=>$data->id))',
            'type' => 'html',
        ),
        array(
            'header' => 'Отрасль науки',
            'name' => 'scienceBranch',
            'value' => 'isset($data->scienceBranch) ? CHtml::link($data->scienceBranch->full_title_nom, array("scienceBranch/view", "id"=>$data->science_branch_id)) : null',
            'type' => 'html',
        ),
        array(
            'class' => 'ext.bootstrap.widgets.BootButtonColumn',
            'htmlOptions' => array('style' => 'width: 50px'),
        ),
        array(
            'class' => 'CDataColumn',
            'type' => 'raw',
            'value' => Speciality::getSubModelMenuFunction('mini'),
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

