<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of inlineCreate
 *
 * @author mrak1990
 */
abstract class contentInlineCreate extends CWidget
{

    private static $count = 0;
    public $jsPrefix;
    public $url;
    public $dialogTitle = 'Добавить запись';
    public $chosenOptions;

    public function init()
    {
        self::$count++;
    }

    public function run()
    {
        $count = self::$count;

        $this->showDialog();

        $cs = Yii::app()->getClientScript();
        $cs->registerScript($count . $this->jsPrefix, "
                function {$this->jsPrefix}CreateItem(title, element) {"
            . CHtml::ajax(array(
                'url' => array($this->url),
                'data' => new CJavaScriptExpression("$(this).serialize() + '&' + $.param( {title: title} )"),
                'type' => 'post',
                'dataType' => 'json',
                'success' => "function(data) {
                            if (data.status == 'failure')
                            {
                                {$this->getFailureAction()}
                            }
                            else
                            {
                                {$this->getSuccessAction()}
                            }
                        }",
            ))
            . 'return false; }
        ', CClientScript::POS_END);
    }

    public function showDialog()
    {
        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => "{$this->jsPrefix}CreateDialog",
            'options' => array(
                'title' => $this->dialogTitle,
                'autoOpen' => false,
                'modal' => true,
                'width' => 700,
                'height' => 470,
            ),
        ));
        echo '<div class="contentDiv"></div>';
        $this->endWidget();
    }

    abstract public function getSuccessAction();

    abstract public function getFailureAction();
}

?>
