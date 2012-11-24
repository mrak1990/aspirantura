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
     * @return array list of items for footer in MyBootGridView
     */
    public function getFooterItems($tableId = null, $GETParam = 'id')
    {
        if ($tableId === null)
            $tableId = $this->class2id() . '-grid';

        $controller = Yii::app()->controller;
        $actionId = $controller->action->id;
        $idData = "$.param({'{$GETParam}': $.fn.yiiGridView.getChecked('{$tableId}', 'checkboxes')})";

        return CMap::mergeArray(array(
            array(
                'value' => CHtml::ajaxLink('В корзину', new CJavaScriptExpression("'{$controller->createUrl('toTrash')}&' + $idData"), array(
                        'type' => 'POST',
                        'success' => new CJavaScriptExpression("$.fn.yiiGridView.update('{$tableId}')"),
                        'error' => new CJavaScriptExpression('function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}'),
                    )
                ),
                'visible' => $actionId === 'index',
            ),
            array(
                'value' => CHtml::ajaxLink('Восстановить', new CJavaScriptExpression("'{$controller->createUrl('restore')}&' + $idData"), array(
                        'type' => 'POST',
                        'success' => new CJavaScriptExpression("$.fn.yiiGridView.update('{$tableId}')"),
                        'error' => new CJavaScriptExpression('function(jqXHR, textStatus, errorThrown) {alert("Error: " + textStatus)}'),
                    )
                ),
                'visible' => $actionId === 'trash',
            ),
        ), parent::getFooterItems($tableId, $GETParam));
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
