<?php
/**
 * ActiveRecord class file
 *
 * @author mrak1990 gmrak1990@gmail.com
 */

class ActiveRecord extends CActiveRecord
{

    const DELETABLE = true;

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
    public function getFooterItems()
    {
        $id = mb_strtolower(get_class($this), 'UTF-8') . '-grid';
        if (static::DELETABLE)
        {
            $actionId = Yii::app()->getController()->action->id;

            return array(
                array(
                    'value' => CHtml::ajaxLink('В корзину', array('toTrash', 'id' => 'many'), array(
                            'type' => 'POST',
                            'data' => new CJavaScriptExpression("{ids : $.fn.yiiGridView.getChecked('{$id}', 'checkboxes')}"),
                            'success' => new CJavaScriptExpression("$.fn.yiiGridView.update('{$id}')"),
                            'error' => new CJavaScriptExpression('function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}'),
                        )
                    ),
                    'visible' => $actionId === 'index',
                ),
                array(
                    'value' => CHtml::ajaxLink('Восстановить', array('restore', 'id' => 'many'), array(
                            'type' => 'POST',
                            'data' => new CJavaScriptExpression("{ids : $.fn.yiiGridView.getChecked('{$id}', 'checkboxes')}"),
                            'success' => new CJavaScriptExpression("$.fn.yiiGridView.update('{$id}')"),
                            'error' => new CJavaScriptExpression('function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}'),
                        )
                    ),
                    'visible' => $actionId === 'trash',
                ),
                array(
                    'value' => CHtml::ajaxLink('Удалить', array('delete', 'id' => 'many'), array(
                            'type' => 'POST',
                            'data' => new CJavaScriptExpression("{ids : $.fn.yiiGridView.getChecked('{$id}', 'checkboxes')}"),
                            'success' => new CJavaScriptExpression("$.fn.yiiGridView.update('{$id}')"),
                            'error' => new CJavaScriptExpression('function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}'),
                        ), array(
                            'confirm' => 'Вы действительно хотите везвозвратно удалить отмеченные записи?',
                        )
                    ),
                    'visible' => $actionId === 'trash',
                ),
            );
        }
        else
        {
            return array(
                array(
                    'value' => CHtml::ajaxLink('Удалить', array('delete', 'id' => 'many'), array(
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
}

?>