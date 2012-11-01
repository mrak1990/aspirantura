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
echo $form->customRow($model, 'code', $this->widget('CMaskedTextField', array(
        'model' => $model,
        'attribute' => 'code',
        'mask' => '99.99.99',
        'htmlOptions' => array(
            'class' => 'span1',
            'maxlength' => 8,
        )
    ), true),
    array(
        'hint' => 'Введите шифр специальности',
    )
);
?>

<?php
echo $form->textFieldRow($model, 'title', array(
    'class' => 'span5',
    'maxlength' => 200,
    'hint' => 'Введите название специальности',
));
?>

<?php
$this->renderPartial('_scienceBranch', array(
    'model' => $model,
    'form' => $form,
    'hint' => 'Начните вводить название отрасли науки, затем выберите её из списка / добавьте в базу',
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
