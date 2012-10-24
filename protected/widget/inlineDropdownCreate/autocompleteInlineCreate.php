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

class autocompleteInlineCreate extends contentInlineCreate
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
//            console.log(data);
            element.val(data.data.title);
            $('#Faculty_staff_id').val(data.data.value);
//            element.trigger('liszt:updated');
//            element.trigger('change');

            $('#{$this->jsPrefix}CreateDialog div.contentDiv').html(data.div);
            setTimeout('$(\'#{$this->jsPrefix}CreateDialog\').dialog(\'close\')', 500);";
    }
}

?>
