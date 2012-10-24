<?php
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
        <div class="page-header"><h3>Параметры фильтрации</h3></div>
        <?php
        echo $form->textFieldRow($model, 'fio', array(
            'class' => 'span4',
            'maxlength' => 50,
        ));
        ?>

        <?php
        echo $form->textFieldRow($model, 'facultyTitle', array(
            'class' => 'span4',
            'maxlength' => 50,
        ));
        ?>

        <?php
        echo $form->textFieldRow($model, 'departmentTitle', array(
            'class' => 'span4',
            'maxlength' => 50,
        ));
        ?>

    </div>
    <div class="span6 last">
        <div class="page-header"><h3>Параметры сортировки</h3></div>
        <?php
        echo $form->dropDownListRow($searchModel, 'sort', $model->getSortAttributes(array(
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
    <?php echo CHtml::submitButton('Найти', array('class' => 'btn primary')); ?>
</div>

<?php $this->endWidget(); ?>
<!-- Search form END -->
