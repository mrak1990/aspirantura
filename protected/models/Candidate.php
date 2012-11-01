<?php

/**
 * This is the model class for table "candidate".
 *
 * The followings are the available columns in table 'candidate':
 * @property integer $id
 * @property integer $department_id
 * @property string $fio
 * @property string $birth
 * @property boolean $is_postgrad
 * @property string $whence
 * @property string $status
 * @property integer $speciality_id
 */
class Candidate extends ActiveRecord
{
    public $facultyId;
    public $advisorFio;

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return Candidate the static model class
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
        return 'candidate';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('fio, department_id, speciality_id, staff_id', 'required'),
            array('department_id, speciality_id, staff_id', 'numerical', 'integerOnly' => true),
            array('fio', 'length', 'max' => 50),
            array('whence', 'length', 'max' => 150),
            array('birth, is_postgrad, status', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, department_id, fio, birth, is_postgrad, whence, status, speciality_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
            'advisor' => array(self::BELONGS_TO, 'Staff', 'staff_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'department_id' => 'Кафедра',
            'facultyId' => 'Факультет',
            'fio' => 'ФИО',
            'staff_id' => 'Научный руководитель',
            'birth' => 'Дата рождения',
            'is_postgrad' => 'Доктор',
            'whence' => 'Откуда',
            'status' => 'Статус',
            'speciality_id' => 'Специальность',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = $this->getDbCriteria();

        $criteria->compare('id', $this->id);
        $criteria->compare('fio', $this->fio, true);
        $criteria->compare('birth', $this->birth, true);
        $criteria->compare('is_postgrad', $this->is_postgrad);
        $criteria->compare('whence', $this->whence, true);
        $criteria->compare('advisor.fio', $this->advisorFio, true);

        $departmentsSelected = false;
        if (is_array($this->department_id))
        {
            if (in_array('', $this->department_id))
                $this->department_id = array_diff($this->department_id, array(''));
            if (!empty($this->department_id))
            {
                $criteria->addInCondition('department.id', $this->department_id);
                $departmentsSelected = true;
            }
        }

        if (!$departmentsSelected && is_array($this->facultyId))
        {
            if (in_array('', $this->facultyId))
                $this->facultyId = array_diff($this->facultyId, array(''));
            if (!empty($this->facultyId))
                $criteria->addInCondition('department.faculty_id', $this->facultyId);
        }

        $criteria->compare('speciality_id', $this->speciality_id);

        return new $this;
    }

    public function behaviors()
    {
        return array(
            'SoftDeleteBehavior' => array(
                'class' => 'application.components.behaviors.TrashBinBehavior',
            ),
            'SortingBehavior' => array(
                'class' => 'application.components.behaviors.SortingBehavior',
            )
        );
    }

    /**
     * @return array for CSort->attributes
     */
    public function getSortAttributes()
    {
        return array(
//            'dean' => array(
//                'asc' => 'dean.fio',
//                'desc' => 'dean.fio DESC',
//            ),
            '*',
        );
    }

    /**
     * Get resolve array for sorted attributes
     *
     * @return array resolved attributes (model_attribute=>attribute_in_CSort)
     */
    public function getResolvedSortOptions()
    {
        return array( //            'staff_id' => 'dean',
        );
    }
}