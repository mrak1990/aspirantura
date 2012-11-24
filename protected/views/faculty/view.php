<?php
/**
 * @var Faculty $model
 * @var Controller $this
 */

$this->breadcrumbs = array_merge(
    $this->breadcrumbs,
    array($model->title)
);
$this->menu = HelperHTML::getMenu(basename(__FILE__, '.php'), $model);
?>

<h2 style="display: inline;">Просмотр записи</h2>
<div id="info-div" style="display: inline;">
    <?php
    $this->renderPartial('_info', array(
        'model' => $model,
    ));
    ?>
</div>

<?php
$this->widget('ext.bootstrap.widgets.BootDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'title',
        'short_title',
        'dean' => array(
            'label' => 'Декан',
            'value' => isset($model->dean)
                ? CHtml::link($model->dean->fio, array(
                        'staff/view',
                        'id' => $model->staff_id
                    )
                )
                : null,
            'type' => 'html',
        ),
        'secretariat',
    ),
));
?>
