<?php

/**
 * This is the model class for table "faculty".
 *
 * The followings are the available columns in table 'faculty':
 * @property integer $id
 * @property integer $institute_id
 * @property string $title
 * @property string $short_title
 * @property integer $staff_id
 * @property string $secretariat
 * @property boolean $deleted
 *
 * The followings are the available model relations:
 * @property Department[] $departments
 * @property Staff[] $staffs
 * @property Staff $staff
 */
class Faculty extends ActiveRecord
{

    const DELETABLE = true;

    public $deanFio;

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return Faculty the static model class
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
        return 'faculty';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('secretariat, staff_id, deleted', 'default', 'value' => null),
            array('title, short_title', 'required'),
            array('staff_id', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 100),
            array('short_title', 'length', 'max' => 20),
            array('secretariat', 'length', 'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, short_title, deanFio, secretariat', 'safe', 'on' => 'search'),
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
            'departments' => array(self::HAS_MANY, 'Department', 'faculty_id'),
            'staffs' => array(self::MANY_MANY, 'Staff', 'vice_dean(faculty_id, staff_id)'),
            'dean' => array(self::BELONGS_TO, 'Staff', 'staff_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'institute_id' => 'Институт',
            'title' => 'Название',
            'short_title' => 'Краткое название',
            'staff_id' => 'Декан',
            'secretariat' => 'Секретариат',
            'deanFio' => 'Декан',
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
        $criteria->compare('institute_id', $this->institute_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('dean.fio', $this->deanFio, true);
        $criteria->compare('secretariat', $this->secretariat, true);

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
            'dean' => array(
                'asc' => 'dean.fio',
                'desc' => 'dean.fio DESC',
            ),
            '*',
        );
    }

    /**
     * Get resolve info for sort attributes
     *
     * @return array
     */
    public function getResolvedSortOptions()
    {
        return array(
            'staff_id' => 'dean',
        );
    }

    public function getFullTitle()
    {
        return "$this->title ({$this->short_title})";
    }
}