<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Yii::import('bootstrap.widgets.input.BootInputHorizontal');

/**
 * Description of MyBootInputHorizontal
 *
 * @author mrak1990
 */
class MyBootInputHorizontal extends BootInputHorizontal
{

    const TYPE_CUSTOM = 'custom';

    /**
     * Renders a drop down list (select).
     * @return string the rendered content
     */
    protected function dropDownList()
    {
        echo $this->getLabel();
        echo '<div class="controls">';
        echo $this->getPrepend();
        echo $this->form->dropDownList($this->model, $this->attribute, $this->data, $this->htmlOptions);
        echo $this->getAppend();
        echo $this->getError() . $this->getHint();
        echo '</div>';
    }

    /**
     * Renders a custom field with specified value.
     * @return string the rendered content
     */
    protected function customField()
    {
        echo $this->getLabel();
        echo '<div class="controls">';
        echo $this->getPrepend();
        echo $this->data;
        echo $this->getAppend();
        echo $this->getError() . $this->getHint();
        echo '</div>';
    }

    public function run()
    {
        echo CHtml::openTag('div', array('class' => 'control-group ' . $this->getContainerCssClass()));

        switch ($this->type)
        {
            case self::TYPE_CHECKBOX:
                $this->checkBox();
                break;

            case self::TYPE_CHECKBOXLIST:
                $this->checkBoxList();
                break;

            case self::TYPE_CHECKBOXLIST_INLINE:
                $this->checkBoxListInline();
                break;

            case self::TYPE_DROPDOWN:
                $this->dropDownList();
                break;

            case self::TYPE_FILE:
                $this->fileField();
                break;

            case self::TYPE_PASSWORD:
                $this->passwordField();
                break;

            case self::TYPE_RADIO:
                $this->radioButton();
                break;

            case self::TYPE_RADIOLIST:
                $this->radioButtonList();
                break;

            case self::TYPE_RADIOLIST_INLINE:
                $this->radioButtonListInline();
                break;

            case self::TYPE_TEXTAREA:
                $this->textArea();
                break;

            case self::TYPE_TEXT:
                $this->textField();
                break;

            case self::TYPE_CAPTCHA:
                $this->captcha();
                break;

            case self::TYPE_UNEDITABLE:
                $this->uneditableField();
                break;

            case self::TYPE_CUSTOM:
                $this->customField();
                break;

            default:
                throw new CException(__CLASS__ . ': Failed to run widget! Type is invalid.');
        }

        echo '</div>';
    }

    /**
     * Returns the hint text for the input.
     * @return string the hint text
     */
    protected function getHint()
    {
        if (isset($this->htmlOptions['hint']))
        {
            $hint = $this->htmlOptions['hint'];
            unset($this->htmlOptions['hint']);
            return '<p class="help-block">' . $hint . '</p>';
        }
        else
            return '';
    }
}

?>
