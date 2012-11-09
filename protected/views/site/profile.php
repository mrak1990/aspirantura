<?php
/**
 * @var User $model
 * @var Controller $this
 */

$this->breadcrumbs = array_merge(
    $this->breadcrumbs,
    array("{$model->username} ({$model->fio})")
);
$this->menu = HelperHTML::getMenu('', $model);
?>
<h2 style="display: inline;">
    <?php
    echo 'Учётная запись&nbsp;';
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
<?php
echo CHtml::link('Сменить пароль', $this->createUrl('user/newPassword', array(
    'id' => $model->id,
)));

$this->renderPartial('application.views.user._form', array(
    'model' => $model,
    'title' => 'Просмотр записи',
));
?>
