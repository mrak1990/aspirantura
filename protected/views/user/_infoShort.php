<?php
/**
 * @var User $model
 * @var Controller $this
 * @var string $title
 */
?>

<h2>
    <?php
    echo $title . '&nbsp;';
    if ($model->deleted)
        $this->widget('ext.bootstrap.widgets.BootLabel', array(
            'type' => 'important',
            'label' => 'В корзине',
            'htmlOptions' => array(
                'title' => 'Этот запись в корзине, возможно её восстановление'
            )
        ));
    ?>
</h2>
