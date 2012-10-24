<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>

<?php echo "<?php\n"; ?>
Yii::app()->clientScript->registerScript('eraser_script', '
$("#dean_eraser").click(function() {
$("#dean_autocomplete").val("").removeAttr("title");
$("#' . CHtml::activeId($model, 'staff_id') . '").val("");
$(this).prop("disabled", true).removeAttr("title");
return false;
});
function eraserActivate(elem, ui) {
elem.val(ui.item.label).attr("title","Текущее значение: " + ui.item.label);
$("#' . CHtml::activeId($model, 'staff_id') . '").val(ui.item.id);
$("#dean_eraser").prop("disabled", false).attr("title","Текущее значение: " + ui.item.label);
}
', CClientScript::POS_READY);

<?php echo "\$form=\$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'" . $this->class2id($this->modelClass) . "-form',
        'type'=>'horizontal',
        'enableClientValidation' => true,
));"; ?>

if (($dean = $model->dean) !== null) {
Yii::app()->clientScript->registerScript('eraser_init', "
eraserActivate($('#dean_autocomplete'), {item:{'id': '$dean->id' , 'label': '$dean->fio'}});
", CClientScript::POS_READY);
}
<?php echo "?>\n"; ?>
<div class="form-note"><em>Поля, помеченные <span class="required">*</span>, обязательны для заполнения.</em></div>

<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php
foreach ($this->tableSchema->columns as $column) {
    if ($column->autoIncrement)
        continue;
    ?>
<?php echo "<?php echo " . $this->generateActiveRow($this->modelClass, $column) . "; ?>\n"; ?>

<?php
}
?>
<div class="form-actions">
    <?php echo "<?php echo CHtml::submitButton(\$model->isNewRecord ? 'Создать' : 'Сохранить',array('class'=>'btn primary')); ?>\n"; ?>
</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>