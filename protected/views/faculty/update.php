<?php
/**
 * @var Faculty $model
 * @var Controller $this
 */

$this->breadcrumbs = array_merge(
    $this->breadcrumbs,
    array(
        $model->title => array(
            'view',
            'id' => $model->id
        ),
        'Редактирование',
    )
);

$this->menu = HelperHTML::getMenu(basename(__FILE__, '.php'), $model);
?>

<h2 style="display: inline;">Редактирование записи</h2>
<div id="info-div" style="display: inline;">
    <?php
    $this->renderPartial('_info', array(
        'model' => $model,
    ));
    ?>
</div>

<?php
echo $this->renderPartial('_form', array(
    'model' => $model
));
?>