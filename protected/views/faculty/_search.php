<?php
/**
 * @var Faculty $model
 * @var MyBootActiveForm $form
 * @var SearchForm $searchModel
 * @var CController $this
 */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('#search-form').toggle();
	return false;
});
");
?>

<!-- Search form BEGIN -->
<?php echo CHtml::link('Параметры поиска', '#', array('class' => 'search-button btn')); ?>
<?php
$form = $this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
    'id' => 'search-form',
    'type' => 'horizontal',
    'action' => $this->createUrl(''),
    'method' => 'GET',
    'htmlOptions' => array(
        'class' => 'non-required-labels',
        'style' => "display:none"
    )
));
?>

<div class="row">
    <div class="span6">
        <div class="page-header">
            <h3>Параметры фильтрации</h3>
        </div>
        <div style="margin-top: -5px; padding-bottom: 15px;">
            <small><em>Введите данные для фильтрации записей. Поиск регистронезависимый, достаточно частичного
                совпадения.</em></small>
        </div>
        <?php
        echo $form->textFieldRow($model, 'title', array(
            'class' => 'span4',
            'maxlength' => 50,
            'hint' => 'Введите название факультета',
        ));
        ?>

        <?php
        echo $form->textFieldRow($model, 'deanFio', array(
            'class' => 'span4',
            'maxlength' => 50,
            'hint' => 'Введите ФИО декана',
        ));
        ?>
    </div>
    <div class="span6 last">
        <div class="page-header"><h3>Параметры сортировки</h3></div>
        <?php
        echo $form->dropDownListRow($searchModel, 'sort', $model->getSortAttributes(array(), array(
                'institute_id',
                'secretariat',
                'deleted',
            )
        ), array(
            'class' => 'span4',
        ));
        echo $form->radioButtonListInlineRow($searchModel, 'direction', array(
            'asc' => 'по возрастанию',
            'desc' => 'по убыванию'
        ));
        ?>
    </div>
</div>
<div class="form-actions">
    <?php echo CHtml::submitButton('Найти', array('class' => 'btn primary')); ?>
</div>

<?php $this->endWidget(); ?>
<!-- Search form END -->
