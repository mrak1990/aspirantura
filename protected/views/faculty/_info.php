<?php
/**
 * @var Faculty $model
 * @var Controller $this
 * @var string $title
 */

if ($model->deleted)
    $this->widget('ext.bootstrap.widgets.BootLabel', array(
        'type' => 'important',
        'label' => 'В корзине',
        'htmlOptions' => array(
            'title' => 'Этот запись в корзине, возможно её восстановление',
        )
    ));
?>

<div class="pull-right btn-toolbar" style="">


    <?php
    $this->widget('application.widget.BootstrapToggleButton.BootstrapToggleButton', array(
        'model' => $model,
        'attribute' => 'deleted',
        'title' => '<b>В корзине</b>',
        'titleWidth' => '70',
        'options' => array(
            'onChange' => new CJavaScriptExpression("function (el, deleted, e) {
                if (deleted) "
                . CHtml::ajax(array(
                    'url' => array(
                        'toTrash',
                        'id' => $model->id
                    ),
                    'type' => 'POST',
                    'update' => '#info-div',
//                                    'error' => new CJavaScriptExpression('function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}'),
                ))
                . " else "
                . CHtml::ajax(array(
                    'url' => array(
                        'restore',
                        'id' => $model->id
                    ),
                    'type' => 'POST',
                    'update' => '#info-div',
//                                    'error' => new CJavaScriptExpression('function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}'),
                ))
                . "}"),
            'label' => array(
                'enabled' => '<i class="icon-ok-sign icon-white"></i> Да',
                'disabled' => '<i class="icon-remove-sign"></i> Нет'
            ),
            'width' => '110',
            'height' => '26'
        )
    ));
    ?>
    <?php
    echo call_user_func(Faculty::getSubModelMenuFunction(), $model);
    ?>
</div>
