<?php
$form = $this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
    'id' => 'user-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
));
?>

<div class="form-note"><em>Поля, помеченные <span class="required">*</span>, обязательны для заполнения.</em></div>

<?php echo $form->errorSummary($model); ?>

<?php
echo $form->textFieldRow($model, 'username', array(
    'class' => 'span5',
    'maxlength' => 20,
    'hint' => 'ЗАПОЛНИТЬ',
));
?>

<?php
echo $form->passwordFieldRow($model, 'password', array(
    'class' => 'span5',
    'maxlength' => 20,
    'hint' => 'ЗАПОЛНИТЬ',
    'disabled' => ($model->isNewRecord) ? false : true,
));
?>

<?php
if ($model->isNewRecord)
    echo $form->passwordFieldRow($model, 'password2', array(
        'class' => 'span5',
        'maxlength' => 20,
        'hint' => 'ЗАПОЛНИТЬ',
    ));
?>

<?php
echo $form->textFieldRow($model, 'email', array(
    'class' => 'span5',
    'maxlength' => 20,
    'hint' => 'ЗАПОЛНИТЬ',
));
?>

<?php
echo $form->textFieldRow($model, 'first_name', array(
    'class' => 'span5',
    'maxlength' => 20,
    'hint' => 'ЗАПОЛНИТЬ',
));
?>

<?php
echo $form->textFieldRow($model, 'last_name', array(
    'class' => 'span5',
    'maxlength' => 20,
    'hint' => 'ЗАПОЛНИТЬ',
));
?>

<?php
echo $form->textFieldRow($model, 'middle_name', array(
    'class' => 'span5',
    'maxlength' => 20,
    'hint' => 'ЗАПОЛНИТЬ',
));
?>

<div class="form-actions">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'btn primary')); ?>
</div>

<?php $this->endWidget(); ?>
