<?php
$form = $this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
    'id' => 'staff-form',
    'type' => 'horizontal',
    'enableClientValidation' => true,
));
?>

<div class="form-note"><em>Поля, помеченные <span class="required">*</span>, обязательны для заполнения.</em></div>

<?php echo $form->errorSummary($model); ?>

<?php

$this->renderPartial('_faculty', array(
    'model' => $model,
    'form' => $form,
    'hint' => 'Заполнить1',
));

$this->renderPartial('_department', array(
    'model' => $model,
    'form' => $form,
    'hint' => 'Заполнить2',
));




?>




<?php
echo $form->textFieldRow($model, 'fio', array(
    'class' => 'span5',
    'maxlength' => 50,
    'hint' => 'ЗАПОЛНИТЬ',
));
?>

<div class="control-group ">
    <?php
    echo CHtml::activeLabelEx($model, 'birth', array(
        'class' => 'control-label',
    ));
    ?>
    <div class="controls">

        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'birth',
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'fold',
            ),
            'htmlOptions' => array(
                'style' => 'height:20px;'
            ),
        ));
        ?>
        <span style="display: none" id="Staff_fio_em_" class="help-inline"></span>

        <p class="help-block">ЗАПОЛНИТЬ</p>
    </div>
</div>
<?php
echo $form->textFieldRow($model, 'academic_position_id', array(
    'class' => 'span5',
    'hint' => 'ЗАПОЛНИТЬ',
));
?>

<?php
echo $form->textFieldRow($model, 'administrative_position_id', array(
    'class' => 'span5',
    'hint' => 'ЗАПОЛНИТЬ',
));
?>

<?php
echo $form->textFieldRow($model, 'scientific_rank_id', array(
    'class' => 'span5',
    'hint' => 'ЗАПОЛНИТЬ',
));
?>

<?php
$this->renderPartial('_sciDegree', array(
    'degrees' => $model->scientificDegrees,
    'form' => $form,
));
?>

<div class="form-actions">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'btn primary')); ?>
</div>

<?php $this->endWidget(); ?>

<?php
//Yii::app()->clientScript->registerScript('trigger_autocomplete', "
//    $('#" . CHtml::getIdByName(CHtml::activeName($model, 'facultyId')) . "').trigger('change');
//");
?>
