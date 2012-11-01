<?php
/**
 * @var $form MyBootActiveForm
 * @var $model Faculty
 * @var $this CController
 */

$form = $this->beginWidget('ext.myBootstrap.MyBootActiveForm', array(
    'id' => 'faculty-form',
    'type' => 'horizontal',
    'enableClientValidation' => true,
));
?>

<div class="form-note"><em>Поля, помеченные <span class="required">*</span>, обязательны для заполнения.</em></div>

<?php echo $form->errorSummary($model); ?>

<?php
echo $form->textFieldRow($model, 'title', array(
    'class' => 'span5',
    'maxlength' => 100,
    'hint' => 'Введите название факультета',
));
?>

<?php
echo $form->textFieldRow($model, 'short_title', array(
    'class' => 'span5',
    'maxlength' => 20,
    'hint' => 'Введите краткое название факультета',
));
?>

<?php
$this->renderPartial('_dean', array(
    'model' => $model,
    'form' => $form,
    'hint' => 'Начните вводить ФИО сотрудника, затем выберите его из списка / добавьте в базу',
));
?>

<?php
echo $form->textFieldRow($model, 'secretariat', array(
    'class' => 'span5',
    'maxlength' => 10,
    'hint' => 'Введите номер кабинета, где располагается секретариат',
));
?>

<div class="form-actions">
    <?php echo CHtml::submitButton($model->isNewRecord
        ? 'Создать'
        : 'Сохранить',
    array(
        'class' => 'btn primary'
    )
);
    ?>
</div>

<?php $this->endWidget(); ?>
