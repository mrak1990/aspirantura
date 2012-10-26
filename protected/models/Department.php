<?php

/**
 * This is the model class for table "department".
 *
 * The followings are the available columns in table 'department':
 * @property integer $id
 * @property integer $faculty_id
 * @property integer $number
 * @property string $title
 * @property integer $staff_id
 * @property boolean $deleted
 *
 * The followings are the available model relations:
 * @property Candidate[] $candidates
 * @property Staff[] $staffs
 * @property Faculty $faculty
 * @property Staff $staff
 */
class Department extends ActiveRecord
{

    public $headFio;
    public $facultyTitle;

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return Department the static model class
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
        return 'department';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('staff_id', 'default', 'value' => null),
            array('faculty_id', 'required', 'message' => 'Необходимо выбрать факультет из списка.'),
            array('title', 'required', 'message' => 'Необходимо указать название кафедры.'),
            array('faculty_id, number, staff_id', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 100),
            array('deleted', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, facultyTitle, number, title, headFio, deleted', 'safe', 'on' => 'search'),
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
            'candidates' => array(self::HAS_MANY, 'Candidate', 'department_id'),
            'staffs' => array(self::HAS_MANY, 'Staff', 'department_id'),
            'faculty' => array(self::BELONGS_TO, 'Faculty', 'faculty_id'),
            'head' => array(self::BELONGS_TO, 'Staff', 'staff_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Название',
            'number' => 'Номер кафедры',
            'faculty_id' => 'Факультет',
            'facultyTitle' => 'Факультет',
            'staff_id' => 'Заведующий',
            'headFio' => 'Заведующий',
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
        $criteria->compare('title', $this->title, true);
        $criteria->compare('number', $this->number);
        if (is_array($this->faculty_id))
        {
            if (($pos = array_search('', $this->faculty_id)) !== false)
                $this->faculty_id = array_diff($this->faculty_id, array(''));
            if (!empty($this->faculty_id))
                $criteria->addInCondition('faculty.id', $this->faculty_id);
        }
        $criteria->compare('head.fio', $this->headFio, true);

        return $this;
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
     * Get array for CSort->attributes
     *
     * @return array
     */
    public function getSortAttributes()
    {
        return array(
            'head' => array(
                'asc' => 'head.fio',
                'desc' => 'head.fio DESC',
            ),
            'faculty' => array(
                'asc' => 'faculty.title',
                'desc' => 'faculty.title DESC',
            ),
            '*',
        );
    }

    public function getResolvedSortOptions()
    {
        return array(
            'staff_id' => 'head',
        );
    }

    public function getFullTitle()
    {
        return isset($this->number) ? "$this->title ($this->number)" : $this->title;
    }
//    static function getAutocompleteData($faculty_id = null)
//    {
//        $criteria = new CDbCriteria();
//
//        if ($faculty_id !== null)
//            $criteria->addCondition("t.faculty_id = $faculty_id");
//
//        $data = Department::model()->findAll($criteria);
//        if (count($data) === 0)
//            $data[] = array(
//                'id' => '',
//                'title' => 'Нет результатов'
//            );
//
//        return CHtml::listData($data, 'id', 'title');
//    }
}