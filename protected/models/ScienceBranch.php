<?php

/**
 * This is the model class for table "scientific_degree".
 *
 * The followings are the available columns in table 'scientific_degree':
 * @property integer $id
 * @property string $title
 * @property string $full_title
 *
 * The followings are the available model relations:
 * @property Speciality[] $specialities
 * @property Staff[] $staffs
 */
class ScienceBranch extends ActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return ScienceBranch the static model class
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
        return 'scientific_degree';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title', 'required'),
            array('title', 'length', 'max' => 25),
            array('full_title', 'length', 'max' => 50),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, full_title', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'specialities' => array(self::HAS_MANY, 'Speciality', 'scientific_degree_id'),
            'staffs' => array(self::MANY_MANY, 'Staff', 'staff_scientific_degree(scientific_degree_id, staff_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Аббревиатура',
            'full_title' => 'Название',
        );
    }
}