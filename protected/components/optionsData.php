<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of optionsData
 *
 * @author mrak1990
 */
class optionsData
{

    public static function getChosenOptions($jsPrefix, $selector)
    {
        return array(
            'no_results_text' => CHtml::link('Добавить запись:', '#', array(
                'onclick' => "{
                    {$jsPrefix}CreateItem(
                        $(this).next('span').html(),
                        $(this).parents('.chzn-container').prev('{$selector}')
                    );
                    $('#{$jsPrefix}CreateDialog').dialog('open');
                }",
            ))
                . ' ',
            'allow_single_deselect' => true,
        );
    }
}

?>
