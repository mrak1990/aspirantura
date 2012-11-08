<?php
/**
 * @var Candidate $model
 * @var Controller $this
 * @var string $hint
 */

$jsPrefix = 'speciality';
$attribute = 'speciality_id';

$selector = '#' . CHtml::activeId($model, $attribute);
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

$data = Speciality::model()->findAll();
$count = count($data);
if ($count === 0)
    $data[] = array();
echo $form->dropDownListRow($model, $attribute, CHtml::listData($data, 'id', 'title'), array(
    'class' => 'span4',
    'maxlength' => 20,
    'hint' => $hint,
    'data-placeholder' => 'Добавить запись...',
));
?>