<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dynamicDropdownAdder
 *
 * @author mrak1990
 */
Yii::import('application.widget.inlineDropdownCreate.contentDynamicAdder');

class chosenDynamicAdder extends contentDynamicAdder
{

    public $target;
    public $chosenOptions;

    public function init()
    {
//        if ($this->chosen_no_results_text === null)
//            $this->chosen_no_results_text = CHtml::link('Добавить запись: ', '#', array(
//                        'onclick' => "{
//                            {$this->jsPrefix}CreateItem(
//                                $(this).next('span').html(),
//                                $(this).parents('.chzn-container').prev('{$this->target}')
//                            );
//                            $('#{$this->jsPrefix}CreateDialog').dialog('open');
//                        }",
//                    ));

        parent::init();
    }

    public function getAddButtonScript()
    {
        $options = CJavaScript::encode($this->chosenOptions);

        return "var {$this->jsPrefix}Template = $('#{$this->jsPrefix}Template');
                var {$this->jsPrefix}TemplateHtml = $.trim({$this->jsPrefix}Template.html());
                var {$this->jsPrefix}ControlDiv = $(this).parent().parent();

                $('#{$this->jsPrefix}AddButton').click(function() {
                    var count = {$this->jsPrefix}Template.data('count');
                    var temp = {$this->jsPrefix}TemplateHtml.replace(/{{i}}/ig, count);
                    
                    $(this)
                        .parent().before(temp)
                        .prev('div.controls').children('select').chosen({$options});                    

                    {$this->jsPrefix}Template.data('count', count+1);

                    return false;
                });";
    }
}

?>
