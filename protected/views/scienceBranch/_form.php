<?php
/**
 * @var $form MyBootActiveForm
 * @var $model ScienceBranch
 * @var $this CController
 */

$form = $this->beginWidget('ext.myBootstrap.MyBootActiveForm', array(
    'id' => 'science-branch-form',
    'type' => 'horizontal',
    'enableClientValidation' => true,
    'htmlOptions' => array(
        'class' => 'labels-width',
    )
));
?>

<div class="form-note"><em>Поля, помеченные <span class="required">*</span>, обязательны для заполнения.</em></div>

<?php echo $form->errorSummary($model); ?>

<?php
echo $form->textFieldRow($model, 'full_title_nom', array(
    'class' => 'span5',
    'maxlength' => 50,
    'hint' => 'Введите название отрасли науки',
));
?>

<?php
echo $form->textFieldRow($model, 'full_title', array(
    'class' => 'span5',
    'maxlength' => 50,
    'hint' => 'Введите название отрасли науки в родительном падеже',
));
?>

<?php
echo $form->textFieldRow($model, 'title', array(
    'class' => 'span5',
    'maxlength' => 25,
    'hint' => 'Введите краткое название отрасли науки в родительном падеже',
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
