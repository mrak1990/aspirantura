<?php
/**
 * @var ScienceBranch $model
 * @var Controller $this
 * @var string $title
 */
?>

<h2 style="display: inline;"><?php echo $title; ?></h2>
<div class="btn-toolbar pull-right">
    <?php
    $this->widget('ext.bootstrap.widgets.BootButtonGroup', array(
        'size' => 'small',
        'buttons' => array(
            array(
                'label' => 'По отрасли науки',
                'icon' => 'search',
                'items' => array(
                    array(
                        'label' => 'специальности',
                        'url' => array(
                            'speciality/index',
                            'Speciality[science_branch_id][]' => $model->id
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
