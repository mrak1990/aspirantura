<?php
/**
 * @var $form MyBootActiveForm
 * @var $model User
 * @var $this CController
 */

$this->breadcrumbs = array_merge(
    $this->breadcrumbs,
    array(
        "{$model->username} ({$model->fio})" => array(
            'view',
            'id' => $model->id
        ),
        'Новое имя пользователя',
    )
);

$form = $this->beginWidget('ext.myBootstrap.MyBootActiveForm', array(
    'id' => 'user-form',
    'type' => 'horizontal',
    'enableClientValidation' => true,
));
?>

<?php
$this->renderPartial('_infoShort', array(
    'model' => $model,
    'title' => 'Изменение имени учётной записи',
));
?>

<div class="form-note"><em>Поля, помеченные <span class="required">*</span>, обязательны для заполнения.</em></div>

<?php echo $form->errorSummary($model); ?>

<?php
echo $form->textFieldRow($model, 'username', array(
    'class' => 'span5',
    'maxlength' => 30,
    'hint' => 'Введите логин пользователя',
));
?>

<div class="form-actions">
    <?php
    echo CHtml::submitButton('Сохранить', array(
        'class' => 'btn primary'
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
