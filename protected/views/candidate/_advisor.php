<?php
/**
 * @var Candidate $model
 * @var Controller $this
 * @var string $hint
 */

$jsPrefix = 'advisor';
$selector = '#' . CHtml::activeId($model, 'staff_id');
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

$data = isset($model->head)
    ? CHtml::listData(array($model->head), 'id', 'fio')
    : array();
echo $form->dropDownListRow($model, 'staff_id', $data, array(
    'class' => 'span5',
    'maxlength' => 20,
    'hint' => $hint,
    'empty' => '',
    'data-placeholder' => 'Искать...',
));
?>