<?php

/**
 * @var Candidate $model
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
<div class="btn-toolbar pull-right">
    <?php
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
