<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class MyStringValidator extends CStringValidator
{
    public $tooShort = 'Слишком короткая строка (минимум {min} символов)';
    public $tooLong = 'Слишком длинная строка (максимум {max} символов)';
}

?>
