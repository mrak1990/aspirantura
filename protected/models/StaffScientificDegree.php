<?php

/**
 * This is the model class for table "staff_scientific_degree".
 *
 * The followings are the available columns in table 'staff_scientific_degree':
 * @property integer $staff_id
 * @property integer $scientific_degree_id
 * @property boolean $doctor
 */
class StaffScientificDegree extends ActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return StaffScientificDegree the static model class
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
        return 'staff_scientific_degree';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('staff_id, scientific_degree_id', 'required'),
            array('staff_id, scientific_degree_id', 'numerical', 'integerOnly' => true),
            array('doctor', 'boolean'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('staff_id, scientific_degree_id, doctor', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'degree' => array(self::BELONGS_TO, 'ScientificDegree', 'scientific_degree_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'staff_id' => 'Сотрудник',
            'scientific_degree_id' => 'Учёная степень',
            'doctor' => 'Тип',
        );
    }

    public function getFullTitle()
    {
        return $this->doctor ? "доктор {$this->degree->full_title}" : "кандидат {$this->degree->full_title}";
    }
}