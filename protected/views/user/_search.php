<?php $form = $this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
)); ?>

<?php echo $form->textFieldRow($model, 'username', array(
    'class' => 'span5',
    'maxlength' => 20,
    'hint' => 'ЗАПОЛНИТЬ',
)); ?>

<?php echo $form->passwordFieldRow($model, 'password_hash', array(
    'class' => 'span5',
    'maxlength' => 20,
    'hint' => 'ЗАПОЛНИТЬ',
)); ?>

<?php echo $form->textFieldRow($model, 'first_name', array(
    'class' => 'span5',
    'maxlength' => 20,
    'hint' => 'ЗАПОЛНИТЬ',
)); ?>

<?php echo $form->textFieldRow($model, 'last_name', array(
    'class' => 'span5',
    'maxlength' => 20,
    'hint' => 'ЗАПОЛНИТЬ',
)); ?>

<?php echo $form->textFieldRow($model, 'middle_name', array(
    'class' => 'span5',
    'maxlength' => 20,
    'hint' => 'ЗАПОЛНИТЬ',
)); ?>

<?php echo $form->textFieldRow($model, 'fullName', array(
    'class' => 'span5',
    'maxlength' => 60,
    'hint' => 'ЗАПОЛНИТЬ',
)); ?>

<div class="actions">
    <?php echo CHtml::submitButton('Search', array('class' => 'btn primary')); ?>
</div>

<?php $this->endWidget(); ?>
