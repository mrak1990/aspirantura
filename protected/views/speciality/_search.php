<?php
/**
 * @var Speciality $model
 * @var MyBootActiveForm $form
 * @var SortForm $searchModel
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
$form = $this->beginWidget('ext.myBootstrap.MyBootActiveForm', array(
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
        echo $form->textFieldRow($model, 'code', array(
            'class' => 'span4',
            'maxlength' => 8,
            'hint' => 'Введите шифр специальности',
        ));
        ?>

        <?php
        echo $form->textFieldRow($model, 'title', array(
            'class' => 'span4',
            'maxlength' => 200,
            'hint' => 'Введите название специальности',
        ));
        ?>

        <?php
        echo $form->dropdownListRow($model, 'science_branch_id', CHtml::listData(ScienceBranch::model()->findAll(), 'id', 'full_title_nom'), array(
            'class' => 'span4',
            'maxlength' => 50,
            'multiple' => true,
            'empty' => 'Все',
            'hint' => 'Выберите нужные отрасли науки (для множественно выбора используйте клавишу <span class="key_button">Ctrl</span> и левую кнопку мышку)',
        ));
        ?>

    </div>
    <div class="span6 last">
        <div class="page-header"><h3>Параметры сортировки</h3></div>
        <?php
        echo $form->dropDownListRow($searchModel, 'sort', $model->getSortOptions(array(), array( //                'institute_id',
//                'secretariat',
//                'deleted',
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
    <?php
    echo CHtml::submitButton('Найти',
        array(
            'class' => 'btn primary'
        ));
    ?>
</div>

<?php $this->endWidget(); ?>
<!-- Search form END -->
