<?php
$form = $this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
    'id' => 'scientific-degree-form',
    'type' => 'horizontal',
    'enableClientValidation' => true,
));
?>
<div class="form-note"><em>Поля, помеченные <span class="required">*</span>, обязательны для заполнения.</em></div>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'title', array(
    'class' => 'span5',
    'maxlength' => 25,
    'hint' => 'ЗАПОЛНИТЬ',
)); ?>

<?php echo $form->textFieldRow($model, 'full_title', array(
    'class' => 'span5',
    'maxlength' => 50,
    'hint' => 'ЗАПОЛНИТЬ',
)); ?>

<div class="form-actions">
    <?php echo CHtml::submitButton($model->isNewRecord
    ? 'Создать'
    : 'Сохранить', array('class' => 'btn primary')); ?>
</div>

<?php $this->endWidget(); ?>
