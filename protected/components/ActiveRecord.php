<?php
/**
 * ActiveRecord class file
 *
 * @author mrak1990 gmrak1990@gmail.com
 */

class ActiveRecord extends CActiveRecord
{

    /**
     * boolean this model can be moved to trash
     */
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
    public function getFooterItems($id = null, $GETParam = 'id')
    {
        if ($id === null)
            $id = mb_strtolower(get_class($this), 'UTF-8') . '-grid';
        if (static::DELETABLE)
        {
            $actionId = Yii::app()->getController()->action->id;

            return array(
                array(
                    'value' => CHtml::ajaxLink('В корзину', array('toTrash', $GETParam => 'many'), array(
                            'type' => 'POST',
                            'data' => new CJavaScriptExpression("{ids : $.fn.yiiGridView.getChecked('{$id}', 'checkboxes')}"),
                            'success' => new CJavaScriptExpression("$.fn.yiiGridView.update('{$id}')"),
                            'error' => new CJavaScriptExpression('function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}'),
                        )
                    ),
                    'visible' => $actionId === 'index',
                ),
                array(
                    'value' => CHtml::ajaxLink('Восстановить', array('restore', $GETParam => 'many'), array(
                            'type' => 'POST',
                            'data' => new CJavaScriptExpression("{ids : $.fn.yiiGridView.getChecked('{$id}', 'checkboxes')}"),
                            'success' => new CJavaScriptExpression("$.fn.yiiGridView.update('{$id}')"),
                            'error' => new CJavaScriptExpression('function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}'),
                        )
                    ),
                    'visible' => $actionId === 'trash',
                ),
                array(
                    'value' => CHtml::ajaxLink('Удалить', array('delete', $GETParam => 'many'), array(
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

    public function defaultScope()
    {
//        CVarDumper::dump($this->getTableAlias(false, false), 10, true);

        return static::DELETABLE && $this->getTableAlias(false, false) === 't'
            ? array('condition' => '"t"."deleted"=\'false\'')
            : array();
    }
}

?>
