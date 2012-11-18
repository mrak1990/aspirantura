<?php
/**
 * @var $form MyBootActiveForm
 * @var $model Candidate
 * @var Disser $disser
 * @var $this CController
 */

$form = $this->beginWidget('ext.myBootstrap.MyBootActiveForm', array(
    'id' => 'candidate-form',
    'type' => 'horizontal',
    'enableClientValidation' => true,
));
?>

<div class="form-note"><em>Поля, помеченные <span class="required">*</span>, обязательны для заполнения.</em></div>

<?php echo $form->errorSummary(array(
    $model,
    $disser
)); ?>

<?php
$this->renderPartial('application.views.staff._faculty', array(
    'model' => $model,
    'form' => $form,
    'hint' => 'Начните вводить название факультета, затем выберите его из списка / добавьте в базу',
));
?>

<?php
$this->renderPartial('application.views.staff._department', array(
    'model' => $model,
    'form' => $form,
    'hint' => 'Начните вводить название кафедры, затем выберите её из списка / добавьте в базу',
));
?>

<?php
echo $form->textFieldRow($model, 'fio', array(
    'class' => 'span5',
    'maxlength' => 50,
    'hint' => 'Введите ФИО аспиранта',
));
?>

<?php
echo $form->radioButtonListInlineRow($model, 'doctor', array(
    '0' => 'кандидат',
    '1' => 'доктор'
));
?>

<?php
echo $form->customRow($model, 'enter_date',
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'model' => $model,
        'attribute' => 'enter_date',
        'htmlOptions' => array(
            'style' => 'height:20px;'
        ),
    ), true),
    array(
        'class' => 'span5',
        'maxlength' => 50,
        'hint' => 'Дата зачисления',
    )
);
?>

<?php
echo $form->customRow($model, 'done_date',
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'model' => $model,
        'attribute' => 'done_date',
        'htmlOptions' => array( //            'style' => 'height:20px;'
        ),
    ), true),
    array(
        'class' => 'span5',
        'maxlength' => 50,
        'hint' => 'Дата окончания',
    )
);
?>

<?php
$this->renderPartial('_advisor', array(
    'model' => $model,
    'form' => $form,
    'hint' => 'Начните вводить ФИО сотрудника, затем выберите его из списка / добавьте в базу',
));
?>

<?php
echo $form->textAreaRow($disser, 'title', array(
    'class' => 'span5',
    'maxlength' => 200,
    'hint' => 'Введите название диссертационной работы',
));
?>

<?php
$this->renderPartial('_speciality', array(
    'model' => $model,
    'form' => $form,
    'hint' => 'Начните вводить код или название специальности, затем выберите его из списка / добавьте в базу',
));
?>

<?php
echo $form->customRow($model, 'birth',
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'model' => $model,
        'attribute' => 'birth',
        'options' => array(
            'showAnim' => 'fold',
        ),
        'htmlOptions' => array(
            'style' => 'height:20px;'
        ),
    ), true),
    array(
        'class' => 'span5',
        'maxlength' => 50,
        'hint' => 'Дата рождения',
    )
);
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
