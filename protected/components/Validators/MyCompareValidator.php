<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyCompareValidator
 *
 * @author mrak1990
 */
class MyCompareValidator extends CCompareValidator
{
    public $message = 'Введённые значения не совпадают.';
    public $strict = true;
}

?>
