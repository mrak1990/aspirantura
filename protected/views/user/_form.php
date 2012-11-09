<?php
/**
 * @var $form MyBootActiveForm
 * @var $model User
 * @var $this CController
 */

$form = $this->beginWidget('ext.myBootstrap.MyBootActiveForm', array(
    'id' => 'user-form',
    'type' => 'horizontal',
    'enableClientValidation' => true,
));
?>

<div class="form-note"><em>Поля, помеченные <span class="required">*</span>, обязательны для заполнения.</em></div>

<?php echo $form->errorSummary($model); ?>

<?php
echo $form->textFieldRow($model, 'username', array(
    'class' => 'span5',
    'maxlength' => 50,
    'hint' => 'Введите имя учётной записи',
    'disabled' => $model->isNewRecord
        ? false
        : true,
));
?>

<?php
if ($model->isNewRecord)
    echo $form->passwordFieldRow($model, 'password', array(
        'class' => 'span5',
        'maxlength' => 50,
        'hint' => 'Введите пароль',
    ));
?>

<?php
if ($model->isNewRecord)
    echo $form->passwordFieldRow($model, 'password2', array(
        'class' => 'span5',
        'maxlength' => 50,
        'hint' => 'Повторите пароль',
    ));
?>

<?php
echo $form->textFieldRow($model, 'first_name', array(
    'class' => 'span5',
    'maxlength' => 30,
    'hint' => 'Введите имя',
));
?>

<?php
echo $form->textFieldRow($model, 'middle_name', array(
    'class' => 'span5',
    'maxlength' => 30,
    'hint' => 'Введите отчество',
));
?>

<?php
echo $form->textFieldRow($model, 'last_name', array(
    'class' => 'span5',
    'maxlength' => 30,
    'hint' => 'Введите фамилию',
));
?>

<?php
echo $form->textFieldRow($model, 'email', array(
    'class' => 'span5',
    'maxlength' => 30,
    'hint' => 'Введите электронную почту',
));
?>

<div class="form-actions">
    <?php
    echo CHtml::submitButton($model->isNewRecord
            ? 'Создать'
            : 'Сохранить',
        array(
            'class' => 'btn primary'
        )
    );
    ?>
</div>

<?php $this->endWidget(); ?>
