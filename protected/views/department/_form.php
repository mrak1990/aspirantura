<?php
/**
 * @var $form MyBootActiveForm
 * @var $model Faculty
 * @var $this CController
 */

$form = $this->beginWidget('ext.myBootstrap.MyBootActiveForm', array(
    'id' => 'department-form',
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
    'hint' => 'Введите название кафедры',
));
?>

<?php
echo $form->textFieldRow($model, 'number', array(
    'class' => 'span5',
    'hint' => 'Введите номер кафедры',
));
?>

<?php
$this->renderPartial('_faculty', array(
    'model' => $model,
    'form' => $form,
    'hint' => 'Начните вводить название факультета, затем выберите его из списка / добавьте в базу',
));
?>

<?php
$this->renderPartial('_head', array(
    'model' => $model,
    'form' => $form,
    'hint' => 'Начните вводить ФИО сотрудника, затем выберите его из списка / добавьте в базу',
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
