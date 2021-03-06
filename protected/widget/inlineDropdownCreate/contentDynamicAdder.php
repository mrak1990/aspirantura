<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dynamicContentAdder
 *
 * @author mrak1990
 */
abstract class contentDynamicAdder extends CWidget
{

    static $count = 0;
    public $jsPrefix;

    public function renderAddButton()
    {
        $this->widget('bootstrap.widgets.BootButton', array(
            'label' => 'Добавить',
            'size' => 'mini',
            'htmlOptions' => array(
                'id' => "{$this->jsPrefix}AddButton",
                'style' => 'margin-top: 5px;',
            )
        ));
    }

    public function init()
    {
        $count = self::$count++;

        $cs = Yii::app()->getClientScript();
        $cs->registerScript("{$count}AddButton", $this->getAddButtonScript(), CClientScript::POS_READY);
        $cs->registerScript("{$count}DeleteButton", $this->getDeleteButtonScript(), CClientScript::POS_READY);
    }

    public function run()
    {
        $this->renderAddButton();
    }

    abstract public function getAddButtonScript();

    public function getDeleteButtonScript()
    {
        return "$('.{$this->jsPrefix}DeleteButton').live('click', function() {  
                    $(this).parent().remove();
                    return false;
                });";
    }
}

?>
