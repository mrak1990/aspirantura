<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SortWidget
 *
 * @author mrak1990
 */
class SortWidget extends CWidget
{

    public $exclude = array();
    public $sortForm;
    public $model;
    public $htmlOptions = array();

    public function init()
    {
        if (!($this->model instanceof CActiveRecord)) {
            throw new CException('Attribute model must be instance of CActiveRecord');
        }
        if (!($this->sortForm instanceof CModel)) {
            throw new CException('Attribute sortForm must be instance of CModel');
        }
    }

    public function run()
    {
        $attributes = $this->model->attributeNames();

        $attributesWithLabels = array();
        foreach ($attributes as $attribute) {
            if (!in_array($attribute, $this->exclude))
                $attributesWithLabels[$attribute] = $this->model->getAttributeLabel($attribute);
        }
        echo CHtml::activeDropDownList($this->sortForm, 'sort', $attributesWithLabels, $this->htmlOptions);
        echo "<br />\n";
        echo "Сортировать:<br />\n" . CHtml::activeRadioButtonList($this->sortForm, 'direction', array('asc' => 'возрастанию', 'desc' => 'убыванию'), array(
                'labelOptions' => array(
                    'style' => 'display: inline',
                )
            )
        );
    }
}

?>
