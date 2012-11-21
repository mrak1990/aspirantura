<?php
/**
 * DeletableActiveRecord class file
 *
 * @author mrak1990 gmrak1990@gmail.com
 */

class DeletableActiveRecord extends ActiveRecord
{
    public $deletedFlagField = 'deleted';
    public $deletedFlag = true;
    public $restoredFlag = false;

    protected function bool2str($value)
    {
        return is_bool($value)
            ? ($value
                ? 'true'
                : 'false')
            : $value;
    }

    /**
     * Get items for footer in table
     * @return array
     */
    public function getFooterItems($id = null, $GETParam = 'id')
    {
        if ($id === null)
            $id = $this->class2id() . '-grid';

        $controller = Yii::app()->controller;
        $actionId = $controller->action->id;
        $idData = "$.param({'id': $.fn.yiiGridView.getChecked('{$id}', 'checkboxes')})";

        return array(
            array(
                'value' => CHtml::ajaxLink('В корзину', new CJavaScriptExpression("'{$controller->createUrl('toTrash')}&' + $idData"), array(
                        'type' => 'POST',
                        'success' => new CJavaScriptExpression("$.fn.yiiGridView.update('{$id}')"),
                        'error' => new CJavaScriptExpression('function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}'),
                    )
                ),
                'visible' => $actionId === 'index',
            ),
            array(
                'value' => CHtml::ajaxLink('Восстановить', array('restore'), array(
//                        'type' => 'POST',
                        'data' => array(
                            'id' => new CJavaScriptExpression("$.fn.yiiGridView.getChecked('{$id}', 'checkboxes')")
                        ),
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
//        return $this->getTableAlias(false, false) === 't'
        return $this->getTableAlias(false, false) === 't' && $this->scenario === ''
            ? array('condition' => '"t"."deleted"=\'false\'')
            : array();
    }

    public function scopes()
    {
        return array(
            'restored' => array(
                'condition' => "\"{$this->getTableAlias()}\".\"{$this->deletedFlagField}\"='{$this->bool2str($this->restoredFlag)}'",
            ),
            'deleted' => array(
                'condition' => "\"{$this->getTableAlias()}\".\"{$this->deletedFlagField}\"='{$this->bool2str($this->deletedFlag)}'",
            )
        );
    }

    public function setDeleted()
    {
        $this->{$this->deletedFlagField} = $this->deletedFlag;

        return $this;
    }

    public function setRestored()
    {
        $this->{$this->deletedFlagField} = $this->restoredFlag;

        return $this;
    }
}

?>
