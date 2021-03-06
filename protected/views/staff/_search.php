<?php
/**
 * @var Staff $model
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
        <div class="page-header"><h3>Параметры фильтрации</h3></div>

        <?php
        echo $form->textFieldRow($model, 'fio', array(
            'class' => 'span4',
            'maxlength' => 50,
        ));
        ?>

        <?php
        echo $form->dropdownListRow($model, 'facultyId', CHtml::listData(Faculty::model()->findAll(), 'id', 'fullTitle'), array(
            'class' => 'span4',
            'maxlength' => 50,
            'multiple' => true,
            'empty' => 'Все',
            'hint' => 'Выберите нужные факультеты из списка (для множественно выбора используйте клавишу <span class="key_button">Ctrl</span> и левую кнопку мышку)',
        ));
        ?>

        <?php
        echo $form->dropdownListRow($model, 'department_id', CHtml::listData(Department::model()->findAll(), 'id', 'fullTitle'), array(
            'class' => 'span4',
            'maxlength' => 50,
            'multiple' => true,
            'empty' => 'Все',
            'hint' => 'Выберите нужные кафедры из списка (для множественно выбора используйте клавишу <span class="key_button">Ctrl</span> и левую кнопку мышку)',
        ));
        ?>

    </div>
    <div class="span6 last">
        <div class="page-header"><h3>Параметры сортировки</h3></div>

        <?php
        echo $form->dropDownListRow($searchModel, 'sort', $model->getSortOptions(array(
                    'departmentTitle',
                    'facultyTitle',
                ), array(
                    'id',
                    'department_id',
                    'deleted',
                )
            ), array(
                'class' => 'span4',
            )
        );
        echo $form->radioButtonListInlineRow($searchModel, 'direction', array('asc' => 'по возрастанию', 'desc' => 'по убыванию'));
        ?>

    </div>
</div>
<div class="form-actions">
    <?php
    echo CHtml::submitButton('Найти', array(
        'class' => 'btn primary'
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
<!-- Search form END -->
