<?php

/**
 * This is the model class for table "staff_scientific_degree".
 *
 * The followings are the available columns in table 'staff_scientific_degree':
 * @property integer $staff_id
 * @property integer $science_branch_id
 * @property boolean $doctor
 */
class ScienceDegree extends ActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return ScienceDegree the static model class
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
        return 'science_degree';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('staff_id, science_branch_id', 'required'),
            array('staff_id, science_branch_id', 'numerical', 'integerOnly' => true),
            array('doctor', 'boolean'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('staff_id, science_branch_id, doctor', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'scienceBranch' => array(self::BELONGS_TO, 'ScienceBranch', 'science_branch_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'staff_id' => 'Сотрудник',
            'science_branch_id' => 'Учёная степень',
            'doctor' => 'Тип',
        );
    }

    /**
     * @return array for CSort->attributes
     */
    public function getSortAttributes()
    {
        return array();
    }

    public function getFullTitle()
    {
        return $this->doctor
            ? "доктор {$this->scienceBranch->full_title}"
            : "кандидат {$this->scienceBranch->full_title}";
    }
}