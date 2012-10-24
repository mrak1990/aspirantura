<?php

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

echo $form->dropDownListRow($model, 'department_id', CHtml::listData(Department::model()->findAll(), 'id', 'title'), array(
    'class' => 'span4',
    'maxlength' => 20,
    'hint' => $hint,
));
?>