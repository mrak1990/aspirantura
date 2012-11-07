<?php
/**
 * @var Staff $model
 * @var Controller $this
 * @var string $hint
 */

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

$data = Faculty::model()->findAll();
$count = count($data);
if ($count === 0)
    $data[] = array(
        'id' => '',
        'title' => 'Записи отсутствуют'
    );
echo $form->dropDownListRow($model, 'facultyId', CHtml::listData($data, 'id', 'title'), array(
    'class' => 'span4',
    'maxlength' => 20,
    'hint' => $hint,
    'empty' => $count ? 'Все' : null,
    'ajax' => array(
        'type' => 'GET',
        'url' => $this->createUrl('department/optionList'),
        'data' => array(
            'parent_id' => new CJavaScriptExpression('this.value'),
        ),
        'success' => new CJavaScriptExpression("function(data) {
            $('#{$idToUpdate}').html(data).trigger('liszt:updated');
        }"),
    )
));
?>