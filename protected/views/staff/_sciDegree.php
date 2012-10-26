<?php
$selector = 'degreeInlineCreate';
$jsPrefix = 'degree';
$chosenOptions = optionsData::getChosenOptions($jsPrefix, $selector);

$this->widget('ext.EChosen.EChosen', array(
    'target' => ".{$selector}",
    'options' => $chosenOptions,
));

$this->widget('application.widget.inlineDropdownCreate.chosenInlineCreate', array(
    'jsPrefix' => $jsPrefix,
    'url' => 'scientificDegree/create',
    'dialogTitle' => 'Добавить учёную степень',
));
?>

<?php
$emptyDegree = new StaffScientificDegree;
?>
<div class="control-group">
    <?php echo CHtml::activeLabel($emptyDegree, 'scientific_degree_id', array('class' => 'control-label')); ?>
    <?php
    $i = 0;
    foreach ($degrees as $degree)
    {
        echo '<div class="controls">';
        echo $form->radioButtonList($degree, "[$i]doctor", array(
            '0' => 'кандидат',
            '1' => 'доктор',
        ), array(
            'inline' => true,
        ));
        echo CHtml::activeDropDownList($degree, "[$i]scientific_degree_id", CHtml::listData(ScientificDegree::model()->findAll(), 'id', 'full_title'), array(
            'class' => "span3 {$selector}",
        ));
        echo CHtml::link('Удалить', '#', array(
            'class' => 'degreeDeleteButton',
        ));

        $i++;
        echo '</div>';
    }
    ?>
    <div class="controls">
        <?php
        $this->widget('application.widget.inlineDropdownCreate.chosenDynamicAdder', array(
            'jsPrefix' => $jsPrefix,
            'target' => ".{$selector}",
            'chosenOptions' => $chosenOptions,
        ));
        ?>
    </div>
    <script type="text/html" id="degreeTemplate" style="display: none;" data-count="<?php echo count($degrees); ?>">
        <?php
        echo '<div class="controls">';
        echo $form->radioButtonList($emptyDegree, '[{{i}}]doctor', array(
            '0' => 'кандидат',
            '1' => 'доктор',
        ), array(
            'inline' => true,
        ));
        echo CHtml::activeDropDownList($emptyDegree, '[{{i}}]scientific_degree_id', CHtml::listData(ScientificDegree::model()->findAll(), 'id', 'full_title'), array(
            'class' => "span3  {$selector}",
        ));
        echo CHtml::link('Удалить', '#', array(
            'class' => 'degreeDeleteButton',
        ));
        echo '</div>';
        ?>
    </script>
</div>