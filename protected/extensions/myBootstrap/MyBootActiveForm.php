<?php

Yii::import('bootstrap.widgets.BootActiveForm');
Yii::import('ext.myBootstrap.MyBootInputHorizontal');

class MyBootActiveForm extends BootActiveForm
{

    const INPUT_HORIZONTAL = 'ext.myBootstrap.MyBootInputHorizontal';

    /**
     * Renders a drop-down list input row.
     *
     * @param CModel $model the data model
     * @param string $attribute the attribute
     * @param array $data the list data
     * @param array $htmlOptions additional HTML attributes
     *
     * @return string the generated row
     */
    public function customRow($model, $attribute, $content = '', $htmlOptions = array())
    {
        return $this->inputRow(MyBootInputHorizontal::TYPE_CUSTOM, $model, $attribute, $content, $htmlOptions);
    }

    /**
     * Returns the input widget class name suitable for the form.
     * @return string the class name
     */
    protected function getInputClassName()
    {
        // Determine the input widget class name.
        switch ($this->type)
        {
            case self::TYPE_HORIZONTAL:
                return self::INPUT_HORIZONTAL;
                break;

            case self::TYPE_INLINE:
                return self::INPUT_INLINE;
                break;

            case self::TYPE_SEARCH:
                return self::INPUT_SEARCH;
                break;

            case self::TYPE_VERTICAL:
            default:
                return self::INPUT_VERTICAL;
                break;
        }
    }
}

?>