<?php

/**
 * BootstrapToggleButton class file.
 *
 * @author   mrak1990 <gmrak1990@gmail.com>
 */
Yii::import('zii.widgets.jui.CJuiInputWidget');

class BootstrapToggleButton extends CJuiInputWidget
{
    public $title;
    public $titleWidth;

    function run()
    {
        list($name, $id) = $this->resolveNameID();

        if (isset($this->htmlOptions['id']))
            $id = $this->htmlOptions['id'];
        else
            $this->htmlOptions['id'] = $id;
        if (isset($this->htmlOptions['name']))
            $name = $this->htmlOptions['name'];

        $width = $this->options['width'] !== null
            ? $this->options['width']
            : 80;
        $labelWidth = $this->title !== null
            ? $this->titleWidth !== null
                ? $this->titleWidth
                : 50
            : 0;
        $totalWidth = $width + $labelWidth + 2;

        $result = '';
        $result .= CHtml::openTag('div', array(
            'id' => $this->id,
            'style' => isset($this->title)
                ? 'left: ' . $labelWidth . 'px;'
                : null
        ));
        if ($this->hasModel())
            $result .= CHtml::activeCheckBox($this->model, $this->attribute, $this->htmlOptions);
        else
            $result .= CHtml::checkBox($name, $this->value, $this->htmlOptions);
        $result .= CHtml::closeTag('div');

        if ($this->title)
        {
            if ($this->hasModel())
                $forID = CHtml::activeId($this->model, $this->attribute);
            else
                $forID = null;
            echo CHtml::openTag('div', array(
                'style' => "position: relative; width: {$totalWidth}px; float: left; margin-right: 10px;"
            ));
            echo CHtml::tag('label', array(
                'style' => 'position: absolute; top: 6px;',
                'for' => $forID
            ), $this->title);
            echo $result;
            echo CHtml::closeTag('div');
        }
        else
            echo $result;

        $options = CJavaScript::encode($this->options);
        $js = "jQuery('#{$this->id}').toggleButtons($options);";

        $cs = Yii::app()->getClientScript();
        $cs->registerScript(__CLASS__ . '#' . $id, $js);
    }

    /**
     * Registers the JS and CSS Files
     *
     * @return void
     */
    public function init()
    {
        $assets = __DIR__ . '/assets';
        $baseUrl = Yii::app()->getAssetManager()->publish($assets);

        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($baseUrl . '/css/bootstrap-toggle-buttons.css');
        $cs->registerScriptFile($baseUrl . '/js/jquery.toggle.buttons.js');
    }
}

?>