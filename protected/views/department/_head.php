<?php
/**
 * @var Department $model
 * @var Controller $this
 * @var string $hint
 */

$jsPrefix = 'head';
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

$data = array();
$data[] = isset($model->head)
    ? $model->head
    : isset($model->staff_id)
        ? Staff::model()->findByPk($model->staff_id)
        : array();
echo $form->dropDownListRow($model, 'staff_id', CHtml::listData($data, 'id', 'fio'), array(
    'class' => 'span5',
    'maxlength' => 20,
    'hint' => $hint,
    'empty' => '',
    'data-placeholder' => 'Искать...',
));
?>