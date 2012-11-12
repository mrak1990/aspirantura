<?php
/**
 * @var $form MyBootActiveForm
 * @var $model ThesisBoard
 * @var $this CController
 */

$form = $this->beginWidget('ext.myBootstrap.MyBootActiveForm', array(
    'id' => 'thesis-board-form',
    'type' => 'horizontal',
    'enableClientValidation' => true,
));
?>

<div class="form-note"><em>Поля, помеченные <span class="required">*</span>, обязательны для заполнения.</em></div>

<?php echo $form->errorSummary(array(
    $model,
)); ?>

<?php
echo $form->textFieldRow($model, 'code', array(
    'class' => 'span5',
    'maxlength' => 20,
    'hint' => 'Введите код совета',
));
?>

<?php
$this->renderPartial('_staff1', array(
    'model' => $model,
    'form' => $form,
    'hint' => 'Начните вводить ФИО сотрудника, затем выберите его из списка / добавьте в базу',
));
?>

<?php
$this->renderPartial('_staff2', array(
    'model' => $model,
    'form' => $form,
    'hint' => 'Начните вводить ФИО сотрудника, затем выберите его из списка / добавьте в базу',
));
?>

<?php
$this->renderPartial('_staff3', array(
    'model' => $model,
    'form' => $form,
    'hint' => 'Начните вводить ФИО сотрудника, затем выберите его из списка / добавьте в базу',
));
?>

<?php
$this->renderPartial('_members', array(
    'members' => $model->members,
    'form' => $form,
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
