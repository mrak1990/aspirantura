<?php
/**
 * @var AuthItem $model
 * @var SortForm $searchModel
 * @var CDbCriteria $criteria
 * @var CSort $sort
 * @var Controller $this
 */

$this->breadcrumbs = array_keys($this->breadcrumbs);
$this->menu = HelperHTML::getMenu(basename(__FILE__, '.php'), new Candidate());

//$this->renderPartial('_search', array(
//    'model' => $model,
//    'searchModel' => $searchModel,
//));

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
        'name' => array(
            'header' => 'Название',
            'name' => 'name',
            'value' => 'CHtml::link($data->name, array("view", "name"=>$data->name))',
            'type' => 'html',
        ),
        'longType:text:Тип',
        'description:text:Описание',
        array(
            'class' => 'ext.bootstrap.widgets.BootButtonColumn',
            'htmlOptions' => array(
                'style' => 'width: 50px',
                                'viewButtonUrl' => '$this->createUrl("view",array("name"=>$data->primaryKey))',
                'updateButtonUrl' => '$this->createUrl("update",array("name"=>$data->primaryKey))',
                'deleteButtonUrl' => '$this->createUrl("delete",array("name"=>$data->primaryKey))',
            ),
        ),
//        array(
//            'class' => 'CDataColumn',
//            'type' => 'raw',
//            'value' => Candidate::getSubModelMenuFunction('mini'),
//            'htmlOptions' => array(
//                'style' => 'width: 37px'
//            ),
//        ),
    ),
    'footer' => array(
        'prepend' => 'С отмеченными: ',
        'class' => 'action-footer',
        'items' => $model->getFooterItems(),
    ),
));

?>

