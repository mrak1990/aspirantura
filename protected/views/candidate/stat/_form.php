<?php
/**
 * @var $form MyBootActiveForm
 * @var $model CandidateStatForm
 * @var $this CController
 */

$form = $this->beginWidget('ext.myBootstrap.MyBootActiveForm', array(
    'id' => 'candidate-form',
    'type' => 'horizontal',
//    'enableClientValidation' => true,
    'method' => 'GET',
    'action' => $this->createUrl('candidate/stat'),
));
?>

<?php echo $form->errorSummary(array($model)); ?>

<?php
echo $form->dropDownListRow($model, 'doctor', array(
    '1' => 'доктора',
    '0' => 'кандидата',
    '' => 'не важно',
));
?>

<?php
echo $form->dropDownListRow($model, 'done', array(
    '1' => 'да',
    '0' => 'нет',
    '' => 'не важно',
));
?>

<?php
echo $form->dropDownListRow($model, 'inTime', array(
    '1' => 'да',
    '0' => 'нет',
    '' => 'не важно',
));
?>

<div class="form-actions">
    <?php
    echo CHtml::submitButton('Искать', array(
        'class' => 'btn primary'
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
