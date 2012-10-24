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

Yii::import('application.widget.inlineDropdownCreate.contentInlineCreate');

class chosenInlineCreate extends contentInlineCreate
{

    public function getFailureAction()
    {
        return "
            $('#{$this->jsPrefix}CreateDialog div.contentDiv').html(data.div);
            $('#{$this->jsPrefix}CreateDialog div.contentDiv form').submit(function(eventObject) {
                return {$this->jsPrefix}CreateItem.call($(this), title, element);
            })";
    }

    public function getSuccessAction()
    {
        return "
            element.append($('<option>', {
                value: data.data.value,
                html: data.data.title,
                selected: 'selected',
            }));
            element.trigger('liszt:updated');
            element.trigger('change');

            $('#{$this->jsPrefix}CreateDialog div.contentDiv').html(data.div);
            setTimeout('$(\'#{$this->jsPrefix}CreateDialog\').dialog(\'close\')', 500);";
    }
}

?>
