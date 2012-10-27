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
class SearchAction extends CAction
{

    public $model;
    public $idField = 'id';
    public $labelField;
    public $searchField;
    public $limit = 10;

    public function run($term)
    {
        $criteria = new CDbCriteria(array(
                'select' => "$this->idField, $this->labelField",
                'limit' => $this->limit,
            )
        );
        $criteria->compare($this->searchField, $term, true);

        $models = $this->model->findAll($criteria);
        $data = CHtml::listData($models, $this->idField, $this->labelField);

        $result = array();
        foreach ($data as $key => $value)
            $result[] = array('id' => $key, 'text' => $value);

        echo CJSON::encode(array(
            'q' => $term,
            'results' => $result));

        Yii::app()->end();
    }
}

?>
