<?php
/**
 * ActiveRecord class file
 *
 * @author mrak1990 gmrak1990@gmail.com
 */

class ActiveRecord extends CActiveRecord
{

    /**
     * Base class for all ActiveRecord models
     * @return boolean
     */
    public function init()
    {
        Yii::import('application.components.validators.*');

        CValidator::$builtInValidators = array_merge(CValidator::$builtInValidators, array(
                'length' => 'MyStringValidator',
                'default' => 'MyDefaultValueValidator',
                'compare' => 'MyCompareValidator',
                'required' => 'MyRequiredValidator',
            )
        );

        return parent::beforeValidate();
    }

    /**
     * Get items for footer in table
     * @return array
     */
    public function getFooterItems($tableId = null, $GETParam = 'id')
    {
        if ($tableId === null)
            $tableId = $this->class2id() . '-grid';

        $controller = Yii::app()->controller;
        $idData = "$.param({'{$GETParam}': $.fn.yiiGridView.getChecked('{$tableId}', 'checkboxes')})";

        return array(
            array(
                'value' => CHtml::ajaxLink('Удалить', new CJavaScriptExpression("'{$controller->createUrl('delete')}&' + $idData"), array(
                        'type' => 'POST',
                        'success' => new CJavaScriptExpression("$.fn.yiiGridView.update('{$tableId}')"),
                        'error' => new CJavaScriptExpression('function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}'),
                    ), array(
                        'confirm' => 'Вы действительно хотите безвозвратно удалить отмеченные записи?',
                    )
                ),
            ),
        );
    }

    /**
     * @return string the id of current exampleModel in form 'example-model'
     */
    public function class2id()
    {
        $name = get_class($this);

        return trim(strtolower(str_replace('_', '-', preg_replace('/(?<![A-Z])[A-Z]/', '-\0', $name))), '-');
    }

    /**
     * Get array for CSort->attributes
     *
     * @return array
     */
    public function getSortAttributes()
    {
        return array('*');
    }

    /**
     * Get function returning callable that return BootButtonGroup
     *
     * @param string $size size of button
     *
     * @return callable function with one parameter $data
     */
    static public function getSubModelMenuFunction($size = '')
    {
        return function ($data) use ($size)
        {
            return '';
        };
    }
}

?>
