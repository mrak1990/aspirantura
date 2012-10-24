<?php

$jsPrefix = 'faculty';
$selector = '#' . CHtml::activeId($model, 'facultyId');
$chosenOptions = optionsData::getChosenOptions($jsPrefix, $selector);
$idToUpdate = CHtml::activeId($model, 'department_id');

$this->widget('ext.EChosen.EChosen', array(
    'target' => $selector,
    'options' => $chosenOptions,
));

$this->widget('application.widget.inlineDropdownCreate.chosenInlineCreate', array(
    'jsPrefix' => $jsPrefix,
    'url' => 'faculty/create',
    'dialogTitle' => 'Добавить факультет',
));

echo $form->dropDownListRow($model, 'facultyId', CHtml::listData(Faculty::model()->findAll(), 'id', 'title'), array(
    'class' => 'span4',
    'maxlength' => 20,
    'hint' => $hint,
    'empty' => 'Все',
    'ajax' => array(
        'type' => 'GET',
        'url' => $this->createUrl('department/optionList'),
        'data' => array(
            'parent_id' => new CJavaScriptExpression('this.value'),
            'show_option_all' => false
        ),
        'success' => new CJavaScriptExpression("function(data) {
            $('#{$idToUpdate}').html(data).trigger('liszt:updated');
        }"),
    )
));
?>