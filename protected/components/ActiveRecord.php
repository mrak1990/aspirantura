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
    public function getFooterItems($id = null, $GETParam = 'id')
    {
        if ($id === null)
            $id = $this->class2id() . '-grid';

        return array(
            array(
                'value' => CHtml::ajaxLink('Удалить', array('delete', $GETParam => 'many'), array(
                        'type' => 'POST',
                        'data' => new CJavaScriptExpression("{ids : $.fn.yiiGridView.getChecked('{$id}', 'checkboxes')}"),
                        'success' => new CJavaScriptExpression("$.fn.yiiGridView.update('{$id}')"),
                        'error' => new CJavaScriptExpression('function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}'),
                    ), array(
                        'confirm' => 'Вы действительно хотите безвозвратно удалить отмеченные записи?',
                    )
                ),
            ),
        );
    }

    public function class2id()
    {
        $name = get_class($this);
        return trim(strtolower(str_replace('_','-',preg_replace('/(?<![A-Z])[A-Z]/', '-\0', $name))),'-');
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
