<?php

/**
 * This is the model class for table "disser".
 *
 * The followings are the available columns in table 'Disser':
 * @property integer $candidate_id
 * @property string $title
 * @property string $status
 */
class Disser extends ActiveRecord
{
    const DELETABLE = false;

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return Disser the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'disser';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('title', 'required'),
            array('title', 'length', 'max' => 200),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'candidate_id' => 'Кандидат',
            'title' => 'Название',
        );
    }

    public function getShortTitle()
    {
        return mb_substr($this->title, 0, 100, 'UTF-8');
    }
}
