<?php
/**
 * @var ThesisBoard $model
 * @var string $hint
 */

$jsPrefix = 'staff2';
$selector = '#' . CHtml::activeId($model, 'staff2_id');
$chosenOptions = optionsData::getChosenOptions($jsPrefix, $selector);

$this->widget('ext.ChosenAjaxAddition.ChosenAjaxAddition', array(
    'target' => $selector,
    'ajaxChosenOptions' => array(
        'generateUrl' => new CJavaScriptExpression("function(q) {
                    return '/aspirantura/index.php?r=staff/search&term=' + q;
                }"),
        'loadingImg' => 'loading.gif',
    ),
    'chosenOptions' => $chosenOptions,
));

$this->widget('application.widget.inlineDropdownCreate.chosenInlineCreate', array(
    'jsPrefix' => $jsPrefix,
    'url' => 'staff/create',
    'dialogTitle' => 'Добавить сотрудника',
));

$data = array();
$data[] = !$model->isNewRecord
    ? $model->staff2
    : isset($model->staff2_id)
        ? Staff::model()->findByPk($model->staff2_id)
        : array();
echo $form->dropDownListRow($model, 'staff2_id', CHtml::listData($data, 'id', 'fio'), array(
    'class' => 'span5',
    'maxlength' => 20,
    'hint' => $hint,
    'empty' => '',
    'data-placeholder' => 'Искать...',
));
?>