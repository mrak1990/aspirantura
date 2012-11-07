<?php
/**
 * @var $form MyBootActiveForm
 * @var $model LoginForm
 * @var $this CController
 */

$form = $this->beginWidget('ext.myBootstrap.MyBootActiveForm', array(
    'id' => 'login-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
));

$this->breadcrumbs = array_merge($this->breadcrumbs, array(
    'Авторизация',
));
?>

<h2>Авторизация</h2>

<div class="form-note"><em>Поля, помеченные <span class="required">*</span>, обязательны для заполнения.</em></div>

<?php
echo $form->textFieldRow($model, 'username', array(
    'class' => 'span3',
    'maxlength' => 30,
//    'hint' => 'Введите имя учётной записи',
));
?>

<?php
echo $form->passwordFieldRow($model, 'password', array(
    'class' => 'span3',
    'maxlength' => 50,
//    'hint' => 'Введите пароль от учётной записи',
));
?>

<?php
echo $form->checkBoxRow($model, 'rememberMe', array(
    'hint' => 'Отметьте галочку, чтобы автоматически войти в следующий раз (действует 1 месяц)',
))
?>

<div class="form-actions">
    <?php
    echo CHtml::submitButton('Войти', array(
        'class' => 'btn primary'
    ));
    ?>
</div>

<?php $this->endWidget(); ?>