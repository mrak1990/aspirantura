<?php
/**
 * @var Department $model
 * @var Controller $this
 * @var string $hint
 */

$jsPrefix = 'faculty';
$selector = '#' . CHtml::activeId($model, 'faculty_id');
$chosenOptions = optionsData::getChosenOptions($jsPrefix, $selector);

$this->widget('ext.EChosen.EChosen', array(
    'target' => $selector,
    'options' => $chosenOptions,
));

$this->widget('application.widget.inlineDropdownCreate.chosenInlineCreate', array(
    'jsPrefix' => $jsPrefix,
    'url' => 'faculty/create',
    'dialogTitle' => 'Добавить факультет',
));

$data = Faculty::model()->findAll();
$count = count($data);
if ($count === 0)
    $data[] = array(
        'id' => '',
        'title' => 'Записи отсутствуют'
    );
echo $form->dropDownListRow($model, 'faculty_id', CHtml::listData($data, 'id', 'title'), array(
    'class' => 'span4',
    'maxlength' => 20,
    'hint' => $hint,
));
?>