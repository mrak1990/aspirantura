<?php
/**
 * DeletableActiveRecord class file
 *
 * @author mrak1990 gmrak1990@gmail.com
 */

class DeletableActiveRecord extends ActiveRecord
{

    /**
     * Get items for footer in table
     * @return array
     */
    public function getFooterItems($id = null, $GETParam = 'id')
    {
        if ($id === null)
            $id = $this->class2id() . '-grid';

        $actionId = Yii::app()->getController()->action->id;

        return array(
            array(
                'value' => CHtml::ajaxLink('В корзину', array('toTrash'), array(
//                        'type' => 'POST',
                        'data' => new CJavaScriptExpression("{id : $.fn.yiiGridView.getChecked('{$id}', 'checkboxes')}"),
                        'success' => new CJavaScriptExpression("$.fn.yiiGridView.update('{$id}')"),
                        'error' => new CJavaScriptExpression('function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}'),
                    )
                ),
                'visible' => $actionId === 'index',
            ),
            array(
                'value' => CHtml::ajaxLink('Восстановить', array('restore'), array(
//                        'type' => 'POST',
                        'data' => new CJavaScriptExpression("{id : $.fn.yiiGridView.getChecked('{$id}', 'checkboxes')}"),
                        'success' => new CJavaScriptExpression("$.fn.yiiGridView.update('{$id}')"),
                        'error' => new CJavaScriptExpression('function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}'),
                    )
                ),
                'visible' => $actionId === 'trash',
            ),
            array(
                'value' => CHtml::ajaxLink('Удалить', array('delete', $GETParam => 'many'), array(
//                        'type' => 'POST',
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

    public function defaultScope()
    {
        return $this->getTableAlias(false, false) === 't'
            ? array('condition' => '"t"."deleted"=\'false\'')
            : array();
    }
}

?>
