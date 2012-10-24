<?php $form = $this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
    'id' => 'auth-item-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
)); ?>

<div class="form-note"><em>Поля, помеченные <span class="required">*</span>, обязательны для заполнения.</em></div>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'name', array(
    'class' => 'span5',
    'maxlength' => 64,
    'hint' => 'ЗАПОЛНИТЬ',
)); ?>

<?php echo $form->textFieldRow($model, 'type', array(
    'class' => 'span5',
    'hint' => 'ЗАПОЛНИТЬ',
)); ?>

<?php echo $form->textAreaRow($model, 'description', array(
    'rows' => 6,
    'cols' => 50,
    'class' => 'span7',
    'hint' => 'ЗАПОЛНИТЬ',
)); ?>

<?php echo $form->textAreaRow($model, 'bizrule', array(
    'rows' => 6,
    'cols' => 50,
    'class' => 'span7',
    'hint' => 'ЗАПОЛНИТЬ',
)); ?>

<?php echo $form->textAreaRow($model, 'data', array(
    'rows' => 6,
    'cols' => 50,
    'class' => 'span7',
    'hint' => 'ЗАПОЛНИТЬ',
)); ?>

<div class="form-actions">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'btn primary')); ?>
</div>

<?php $this->endWidget(); ?>
