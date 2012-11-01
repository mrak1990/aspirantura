<?php
/**
 * @var Candidate $model
 * @var Controller $this
 * @var string $hint
 */

$jsPrefix = 'speciality';
$selector = '#' . CHtml::activeId($model, 'staff_id');
$chosenOptions = optionsData::getChosenOptions($jsPrefix, $selector);

$this->widget('ext.EChosen.EChosen', array(
    'target' => $selector,
    'options' => $chosenOptions,
));

$this->widget('application.widget.inlineDropdownCreate.chosenInlineCreate', array(
    'jsPrefix' => $jsPrefix,
    'url' => 'speciality/create',
    'dialogTitle' => 'Добавить специальность',
));

echo $form->dropDownListRow($model, 'staff_id', CHtml::listData(Speciality::model()->findAll(), 'id', 'title'), array(
    'class' => 'span4',
    'maxlength' => 20,
    'hint' => $hint,
    'empty' => 'Все',
));
?>