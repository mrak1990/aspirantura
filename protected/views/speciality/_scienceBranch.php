<?php
/**
 * @var Speciality $model
 * @var Controller $this
 * @var string $hint
 */

$jsPrefix = 'scienceBranch';
$selector = '#' . CHtml::activeId($model, 'science_branch_id');
$chosenOptions = optionsData::getChosenOptions($jsPrefix, $selector);

$this->widget('ext.EChosen.EChosen', array(
    'target' => $selector,
    'options' => $chosenOptions,
));

$this->widget('application.widget.inlineDropdownCreate.chosenInlineCreate', array(
    'jsPrefix' => $jsPrefix,
    'url' => 'scienceBranch/create',
    'dialogTitle' => 'Добавить отрасль науки',
));

echo $form->dropDownListRow($model, 'science_branch_id', CHtml::listData(scienceBranch::model()->findAll(), 'id', 'full_title_nom'), array(
    'class' => 'span4',
    'maxlength' => 20,
    'hint' => $hint,
));
?>