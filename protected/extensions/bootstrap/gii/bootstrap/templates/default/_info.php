<?php echo "<?php\n"; ?>

/**
* @var <?php echo $this->modelClass; ?> $model
* @var Controller $this
* @var string $title
*/
?>

<h2 style="display: inline;">
    <?php echo "<?php\n"; ?>
    echo $title . '&nbsp;';
    if ($model->deleted)
    $this->widget('ext.bootstrap.widgets.BootLabel', array(
    'type' => 'important',
    'label' => 'В корзине',
    'htmlOptions' => array(
    'title' => 'Этот запись в корзине, возможно её восстановление'
    )
    )
    );
    ?>
</h2>
<div class="btn-toolbar pull-right">
    <?php echo "<?php\n"; ?>
    $this->widget('ext.bootstrap.widgets.BootButtonGroup', array(
    'size' => 'small',
    'buttons' => array(
    array(
    'label' => 'label',
    'icon' => 'search',
    'items' => array(
    array(
    'label' => 'label',
    'url' => array(
    '#',
    )
    ),
    '---',
    array(
    'label' => 'что-то ещё',
    'url' => '#'
    ),
    )
    ),
    ),
    ), false);
    ?>
</div>
