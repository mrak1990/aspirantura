<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ListAction
 *
 * @author mrak1990
 */
class ListAction extends CAction
{

    public $model;
    public $idField = 'id';
    public $labelField;
    public $parentIdField;
    public $emptyText = 'Нет результатов';

    public function run($parent_id = null)
    {
        $criteria = new CDbCriteria(array(
                'select' => "$this->idField, $this->labelField",
            )
        );

        if (isset($parent_id) && $parent_id !== '')
            $criteria->compare($this->parentIdField, $parent_id);

//        CVarDumper::dump($criteria, 10, true);

        $data = $this->model->findAll($criteria);
        $data = CHtml::listData($data, $this->idField, $this->labelField);

        $result = '';
        if (count($data) === 0)
            $result = "<option value=\"\">{$this->emptyText}</option>";
        else
        {
            foreach ($data as $key => $value)
                $result .= "<option value=\"{$key}\">{$value}</option>";
        }

        echo $result;
        Yii::app()->end();
    }
}

?>
