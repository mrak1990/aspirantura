<?php
/**
 * @var ThesisBoard $model
 * @var Controller $this
 */

$this->breadcrumbs = array_merge(
    $this->breadcrumbs,
    array($model->code)
);
$this->menu = HelperHTML::getMenu(basename(__FILE__, '.php'), $model);

$this->renderPartial('_info', array(
    'model' => $model,
    'title' => 'Просмотр записи',
));
?>
<div class="row">
    <div class="span7">
        <?php
        $this->widget('ext.bootstrap.widgets.BootDetailView', array(
            'data' => $model,
            'attributes' => array(
                'id',
                'code',
                'staff1' => array(
                    'name' => 'staff_id',
                    'value' => CHtml::link($model->staff1->fio, array(
                        'staff/view',
                        'id' => $model->staff_id
                    )),
                    'type' => 'html',
                ),
                'staff2' => array(
                    'name' => 'staff2_id',
                    'value' => $model->staff2 !== null
                        ? CHtml::link($model->staff2->fio, array(
                            'staff/view',
                            'id' => $model->staff2_id
                        ))
                        : null,
                    'type' => 'html',
                ),
                'staff3' => array(
                    'name' => 'staff3_id',
                    'value' => $model->staff3 !== null
                        ? CHtml::link($model->staff3->fio, array(
                            'staff/view',
                            'id' => $model->staff3_id
                        ))
                        : null,
                    'type' => 'html',
                ),
            ),
            'htmlOptions' => array(
                'class' => 'width-detail-view',
            ),
        ));
        ?>
    </div>
    <div class="span5">
        <h3>Состав совета</h3>
        <ul class="nav nav-pills nav-stacked">
            <?php
            foreach ($model->getMembers() as $data)
                echo "<li>{$data}</li>";
            ?>
        </ul>
    </div>
</div>

