<?php
/**
 * @var ScienceDegree[] $degrees
 * @var Controller $this
 * @var string $hint
 */

$jsPrefix = 'degrees';
$selector = 'degreesInlineCreate';
$prefixedSelector = '.' .$selector;
$chosenOptions = optionsData::getChosenOptions($jsPrefix, $prefixedSelector);

$data = ScienceBranch::model()->findAll();
$count = count($data);
if ($count === 0)
    $data[] = array(
        'id' => '',
        'full_title' => 'Записи отсутствуют'
    );

$this->widget('ext.EChosen.EChosen', array(
    'target' => $prefixedSelector,
    'options' => $chosenOptions,
));

$this->widget('application.widget.inlineDropdownCreate.chosenInlineCreate', array(
    'jsPrefix' => $jsPrefix,
    'url' => 'scienceBranch/create',
    'dialogTitle' => 'Добавить учёную степень',
));
?>

<?php
$emptyDegree = new ScienceDegree();
?>
<div class="control-group degrees-add">
    <?php
    echo CHtml::activeLabel($emptyDegree, 'science_branch_id', array(
        'class' => 'control-label'
    ));
    ?>
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

        echo CHtml::activeDropDownList($degree, "[$i]science_branch_id", CHtml::listData($data, 'id', 'full_title'), array(
            'class' => "span3 {$selector}",
        ));

        $this->widget('bootstrap.widgets.BootButton', array(
            'label' => 'Удалить',
            'size' => 'mini',
            'type' => 'danger',
            'htmlOptions' => array(
                'class' => 'degreesDeleteButton',
            )
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
    <script type="text/html" id="<?php echo $jsPrefix; ?>Template" style="display: none;"
            data-count="<?php echo count($degrees); ?>">
        <?php
        echo '<div class="controls">';
        echo $form->radioButtonList($emptyDegree, '[{{i}}]doctor', array(
            '0' => 'кандидат',
            '1' => 'доктор',
        ), array(
            'inline' => true,
        ));

        echo CHtml::activeDropDownList($emptyDegree, '[{{i}}]science_branch_id', CHtml::listData($data, 'id', 'full_title'), array(
            'class' => "span3 {$selector}",
        ));

        $this->widget('bootstrap.widgets.BootButton', array(
            'label' => 'Удалить',
            'size' => 'mini',
            'type' => 'danger',
            'htmlOptions' => array(
                'class' => 'degreesDeleteButton',
            )
        ));

        echo '</div>';
        ?>
    </script>
</div>