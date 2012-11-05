<?php
/**
 * @var Department $model
 * @var Controller $this
 * @var string $title
 */
?>

<h2 style="display: inline;">
    <?php
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
<div class="pull-right">
    <?php
    echo call_user_func(Department::getSubModelMenuFunction(''), $model);
    ?>
</div>
