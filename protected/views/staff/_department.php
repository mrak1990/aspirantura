<?php
/**
 * @var Staff $model
 * @var Controller $this
 * @var string $hint
 */

$jsPrefix = 'department';
$selector = '#' . CHtml::activeId($model, 'department_id');
$chosenOptions = optionsData::getChosenOptions($jsPrefix, $selector);

$this->widget('ext.EChosen.EChosen', array(
    'target' => $selector,
    'options' => $chosenOptions,
));

$this->widget('application.widget.inlineDropdownCreate.chosenInlineCreate', array(
    'jsPrefix' => $jsPrefix,
    'url' => 'department/create',
    'dialogTitle' => 'Добавить кафедру',
));

$data = Department::model()->findAll();
if (count($data) === 0)
    $data[] = array(
        'id' => '',
        'title' => 'Записи отсутствуют'
    );
echo $form->dropDownListRow($model, 'department_id', CHtml::listData($data, 'id', 'title'), array(
    'class' => 'span4',
    'maxlength' => 20,
    'hint' => $hint,
));
?>