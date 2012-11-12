<?php
/**
 * @var Member[] $members
 * @var Controller $this
 * @var string $hint
 */

$jsPrefix = 'members';
$selector = 'membersInlineCreate';
$prefixedSelector = '.' . $selector;
$chosenOptions = optionsData::getChosenOptions($jsPrefix, $prefixedSelector);

$data = Staff::model()->findAll();
$count = count($data);
if ($count === 0)
    $data[] = array(
        'id' => '',
        'fio' => 'Записи отсутствуют'
    );

$this->widget('ext.EChosen.EChosen', array(
    'target' => $prefixedSelector,
    'options' => $chosenOptions,
));

$this->widget('application.widget.inlineDropdownCreate.chosenInlineCreate', array(
    'jsPrefix' => $jsPrefix,
    'url' => 'staff/create',
    'dialogTitle' => 'Добавить сотрудника',
));
?>

<?php
$emptyMember = new Member();
?>
<div class="control-group multiple-inline-add-crop">
    <?php
    echo CHtml::activeLabel($emptyMember, 'staff_id', array(
        'class' => 'control-label'
    ));
    ?>
    <?php
    $i = 0;
    foreach ($members as $member)
    {
        echo '<div class="controls">';

        echo CHtml::activeDropDownList($member, "[$i]staff_id", CHtml::listData($data, 'id', 'fio'), array(
            'class' => "span3 {$selector}",
        ));

        $this->widget('bootstrap.widgets.BootButton', array(
            'label' => 'Удалить',
            'size' => 'mini',
            'type' => 'danger',
            'htmlOptions' => array(
                'class' => 'membersDeleteButton',
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
            data-count="<?php echo count($members); ?>">
        <?php
        echo '<div class="controls">';

        echo CHtml::activeDropDownList($emptyMember, '[{{i}}]staff_id', CHtml::listData($data, 'id', 'fio'), array(
            'class' => "span3 {$selector}",
        ));

        $this->widget('bootstrap.widgets.BootButton', array(
            'label' => 'Удалить',
            'size' => 'mini',
            'type' => 'danger',
            'htmlOptions' => array(
                'class' => 'membersDeleteButton',
            )
        ));

        echo '</div>';
        ?>
    </script>
</div>