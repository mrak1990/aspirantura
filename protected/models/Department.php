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
        return array(
            array('staff_id', 'default', 'value' => null),
            array('faculty_id', 'required', 'message' => 'Необходимо выбрать факультет из списка.'),
            array('title', 'required', 'message' => 'Необходимо указать название кафедры.'),
            array('faculty_id, number, staff_id', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 100),
            array('deleted', 'safe'),
            array('id, facultyTitle, number, title, headFio, deleted', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
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
        $criteria = $this->getDbCriteria();

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('number', $this->number);
        if (is_array($this->faculty_id))
        {
            $this->faculty_id = array_diff($this->faculty_id, array(''));
            if (!empty($this->faculty_id))
                $criteria->addInCondition('faculty_id', $this->faculty_id);
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
     * @return array for CSort->attributes
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

    /**
     * Get resolve array for sorted attributes
     *
     * @return array resolved attributes (model_attribute=>attribute_in_CSort)
     */
    public function getResolvedSortOptions()
    {
        return array(
            'staff_id' => 'head',
        );
    }

    /**
     * Get title with number in braces
     *
     * @return string
     */
    public function getFullTitle()
    {
        return isset($this->number)
            ? "$this->title ($this->number)"
            : $this->title;
    }

    /**
     * Get function returning callable that return BootButtonGroup
     *
     * @param string $size size of button
     *
     * @return callable function with one parameter $data
     */
    static public function getSubModelMenuFunction($size = '')
    {
        return function ($data) use ($size)
        {
            return Yii::app()->controller->widget("ext.bootstrap.widgets.BootButtonGroup", array(
                'size' => $size,
                'buttons' => array(
                    array(
                        'icon' => 'arrow-down',
                        'items' => array(
                            array(
                                'label' => 'Сотрудники',
                                'url' => array(
                                    'staff/index',
                                    'Staff[department_id][]' => $data->id
                                ),
                                'linkOptions' => array(
                                    'title' => 'Сотрудники на факультете',
                                )
                            ),
                            array(
                                "label" => "Аспиранты",
                                "url" => array(
                                    'candidate/index',
                                    'Candidate[department_id][]' => $data->id
                                ),
                                'linkOptions' => array(
                                    'title' => 'Аспиранты на факультете',
                                )
                            ),
                        )
                    ),
                ),
            ), true);
        };
    }
}