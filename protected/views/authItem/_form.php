<?php
$form = $this->beginWidget('ext.bootstrap.widgets.BootActiveForm', array(
    'id' => 'auth-item-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
));

$this->widget('application.widget.emultiselect.EMultiSelect', array(
        'sortable' => true,
        'searchable' => true,
        'dividerLocation' => 0.5,
        'height' => 150,
        'width' => 540,
    )
);

$allAuthItems = AuthItem::getAll($model->name);
?>

<div class="form-note"><em>Поля, помеченные <span class="required">*</span>, обязательны для заполнения.</em></div>

<?php
echo $form->errorSummary($model);

echo $form->textFieldRow($model, 'name', array(
    'class' => 'span5',
    'maxlength' => 64,
    'hint' => 'ЗАПОЛНИТЬ',
));
echo $form->dropDownListRow($model, 'type', AuthItem::$types, array(
    'class' => 'span5',
    'hint' => 'ЗАПОЛНИТЬ',
    'disabled' => $model->isNewRecord ? false : true,
));
echo $form->textAreaRow($model, 'description', array(
    'rows' => 3,
    'cols' => 50,
    'class' => 'span7',
    'hint' => 'ЗАПОЛНИТЬ',
));
echo $form->dropDownListRow($model, 'users', User::getAll('user'), array(
    'multiple' => 'multiple',
    'class' => 'multiselect',
    'hint' => 'ЗАПОЛНИТЬ',
    'key' => 'userid',
));
?>

<h3>Родители
    <small>Элементы авторизации, правами которых будет обладать этот элемент</small>
</h3>

<?php
echo $form->dropDownListRow($model, 'parents[roles]', $allAuthItems['roles'], array(
    'multiple' => 'multiple',
    'class' => 'multiselect',
    'hint' => 'ЗАПОЛНИТЬ',
));
if (!isset($model->type) || $model->type <= 1)
    echo $form->dropDownListRow($model, 'parents[tasks]', $allAuthItems['tasks'], array(
        'multiple' => 'multiple',
        'class' => 'multiselect',
        'hint' => 'ЗАПОЛНИТЬ',
    ));
if (!isset($model->type) || $model->type === 0)
    echo $form->dropDownListRow($model, 'parents[operations]', $allAuthItems['operations'], array(
        'multiple' => 'multiple',
        'class' => 'multiselect',
        'hint' => 'ЗАПОЛНИТЬ',
    ));
?>

<h3>Потомки
    <small>Элементы авторизации, которые будут обладать правами текущего элемента</small>
</h3>

<?php
if (!isset($model->type) || $model->type === 2)
    echo $form->dropDownListRow($model, 'children[roles]', $allAuthItems['roles'], array(
        'multiple' => 'multiple',
        'class' => 'multiselect',
        'hint' => 'ЗАПОЛНИТЬ',
    ));
if (!isset($model->type) || $model->type >= 1)
    echo $form->dropDownListRow($model, 'children[tasks]', $allAuthItems['tasks'], array(
        'multiple' => 'multiple',
        'class' => 'multiselect',
        'hint' => 'ЗАПОЛНИТЬ',
    ));
echo $form->dropDownListRow($model, 'children[operations]', $allAuthItems['operations'], array(
    'multiple' => 'multiple',
    'class' => 'multiselect',
    'hint' => 'ЗАПОЛНИТЬ',
));
?>

<div class="form-actions">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'btn primary')); ?>
</div>

<?php $this->endWidget(); ?>
