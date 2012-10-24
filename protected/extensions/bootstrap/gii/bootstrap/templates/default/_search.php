<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>

<?php
echo "<?php\n";
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('#search-form').toggle();
	return false;
});
");
?>

<?php echo "\$form=\$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
    'id' => 'search-form',
    'type' => 'horizontal',
    'action' => \$this->createUrl(''),
    'method' => 'GET',
    'htmlOptions' => array(
        'class' => 'non-required-labels',
        'style' => \"display:none\"
    )
)); ?>\n"; ?>

<div class="row">
    <div class="span6">
        <div class="page-header"><h3>Параметры фильтрации</h3></div>
        <?php foreach ($this->tableSchema->columns as $column): ?>
        <?php
        $field = $this->generateInputField($this->modelClass, $column);
        if (strpos($field, 'password') !== false)
            continue;
        ?>
        <?php echo "<?php echo " . $this->generateActiveRow($this->modelClass, $column) . "; ?>\n"; ?>
        <?php endforeach; ?>
    </div>
    <div class="span6 last">
        <div class="page-header"><h3>Параметры сортировки</h3></div>
        <?php echo "<?php\n"; ?>
        echo $form->dropDownListRow($searchModel, 'sort', $model->getSortAttributes(array(
        'deleted'
        )
        ), array(
        'class' => 'span4',
        ));
        echo $form->radioButtonListInlineRow($searchModel, 'direction', array('asc' => 'по возрастанию', 'desc' => 'по
        убыванию'));
        ?>
    </div>
</div>
<div class="actions">
    <?php echo "<?php echo CHtml::submitButton('Search',array('class'=>'btn primary')); ?>\n"; ?>
</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>