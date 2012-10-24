<?php
$this->breadcrumbs = array_merge($this->breadcrumbs, array(
    'Администрирование',
));

$this->menu = array(
    array('label' => 'Все записи', 'icon' => 'list', 'url' => array('index')),
    array('label' => 'Добавить элемент', 'icon' => 'plus', 'url' => array('create')),

);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('staff-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>Администрирование</h2>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
    &lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button btn')); ?>
<div class="search-form" style="display:none">
    <?php //$this->renderPartial('_search',array(
    //'model'=>$model,
//)); ?>
</div><!-- search-form -->

<?php $this->widget('ext.bootstrap.widgets.BootGridView', array(
    'id' => 'staff-grid',
    'dataProvider' => new CActiveDataProvider($model->search()),
    'filter' => $model,
    'columns' => array(
        'id',
        'department_id',
        'fio',
        'birth',
        'academic_position_id',
        'administrative_position_id',
        /*
        'scientific_rank_id',
        'deleted',
        */
        array(
            'class' => 'CButtonColumn',
        ),
    ),
)); ?>
