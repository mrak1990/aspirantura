<?php

/**
 * This is the model class for table "staff".
 *
 * The followings are the available columns in table 'staff':
 * @property integer $id
 * @property integer $department_id
 * @property string $fio
 * @property string $birth
 * @property integer $academic_position_id
 * @property integer $administrative_position_id
 * @property integer $scientific_rank_id
 * @property boolean $deleted
 *
 * The followings are the available model relations:
 * @property Candidate[] $candidates
 * @property ThesisBoard[] $thesisBoards
 * @property ThesisBoard[] $thesisBoards1
 * @property ThesisBoard[] $thesisBoards2
 * @property Cite $cite
 * @property Disser[] $dissers
 * @property scienceBranch[] $scienceDegrees
 * @property Department $department
 * @property AcademicPosition $academicPosition
 * @property AdministrativePosition $administrativePosition
 * @property ScientificRank $scientificRank
 * @property Department[] $departments
 * @property Faculty[] $faculties
 * @property Faculty[] $faculties1
 */
class Staff extends ActiveRecord
{

    public $facultyId;

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return Staff the static model class
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
        return 'staff';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('birth', 'default', 'value' => null),
            array('department_id', 'required', 'message' => 'Необходимо выбрать кафедру'),
            array('fio', 'required'),
            array('fio', 'length', 'max' => 50),
            array('department_id, academic_position_id, administrative_position_id, scientific_rank_id', 'numerical', 'integerOnly' => true),
            array('facultyId, birth', 'safe'),
            array('id, facultyTitle, departmentTitle, fio, birth, academic_position_id, administrative_position_id, scientific_rank_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
            'candidates1' => array(self::HAS_MANY, 'Candidate', 'staff_id', 'scopes' => 'undone'),
            'candidates2' => array(self::HAS_MANY, 'Candidate', 'staff_id', 'scopes' => 'done'),
//            'faculty' => array(self::HAS_ONE, 'Faculty', 'faculty_id', 'through' => 'department'),
//            'members' => array(self::HAS_MANY, 'Member', 'staff_id'),
//            'thesisBoards' => array(self::HAS_MANY, 'ThesisBoard', 'staff_id'),
//            'thesisBoards1' => array(self::HAS_MANY, 'ThesisBoard', 'staff2_id'),
//            'thesisBoards2' => array(self::HAS_MANY, 'ThesisBoard', 'staff3_id'),
//            'cite' => array(self::HAS_ONE, 'Cite', 'staff_id'),
//            'dissers' => array(self::MANY_MANY, 'Disser', 'advisor(staff_id, disser_id)'),
            'scienceDegrees' => array(self::HAS_MANY, 'ScienceDegree', 'staff_id'),
//            'academicPosition' => array(self::BELONGS_TO, 'AcademicPosition', 'academic_position_id'),
//            'administrativePosition' => array(self::BELONGS_TO, 'AdministrativePosition', 'administrative_position_id'),
//            'scientificRank' => array(self::BELONGS_TO, 'ScientificRank', 'scientific_rank_id'),
//            'departments' => array(self::HAS_MANY, 'Department', 'staff_id'),
//            'faculties' => array(self::MANY_MANY, 'Faculty', 'vice_dean(staff_id, faculty_id)'),
//            'faculties1' => array(self::HAS_MANY, 'Faculty', 'staff_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'facultyId' => 'Факультет',
            'department_id' => 'Кафедра',
            'fio' => 'ФИО',
            'birth' => 'Дата рождения',
            'academic_position_id' => 'Учёное звание',
            'administrative_position_id' => 'Должность',
            'scientific_rank_id' => 'Учёная степень',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = $this->getDbCriteria();

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.fio', $this->fio, true);
        $criteria->compare('t.birth', $this->birth, true);

        if (is_array($this->department_id))
        {
            $this->department_id = array_diff($this->department_id, array(''));
            if (!empty($this->department_id))
            {
                $criteria->addInCondition('t.department_id', $this->department_id);
                $this->facultyId = null;
            }
        }

        if (is_array($this->facultyId))
        {
            $this->facultyId = array_diff($this->facultyId, array(''));
            if (!empty($this->facultyId))
                $criteria->addInCondition('department.faculty_id', $this->facultyId);
        }

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
            ),
        );
    }

    /**
     * @return array for CSort->attributes
     */
    public function getSortAttributes()
    {
        return array(
            'departmentTitle' => array(
                'asc' => 'department.title',
                'desc' => 'department.title DESC',
            ),
            'facultyTitle' => array(
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
        return array();
    }

    public function afterFind()
    {
        if ($this->department !== null)
            $this->facultyId = $this->department->faculty_id;

        if (Yii::app()->controller->action->id === 'update')
            foreach ($this->scienceDegrees as $degree)
                $degree->doctor
                    = $degree->doctor
                    ? 1
                    : 0;

        parent::afterFind();
    }

    /**
     * Update science degrees, belonged to this model
     *
     * @param array $degrees from $_POST
     */
    public function updateScienceDegrees(array $degrees)
    {
        if ($this->isNewRecord || count($this->scienceDegrees) === 0)
        {
            foreach ($degrees as $degreeData)
            {
                $degree = new ScienceDegree();
                $degree->attributes = $degreeData;
                $degree->staff_id = $this->id;
                $degree->save();
            }
        }
        else
        {
            $degreesOldIds = array_map(function ($value)
            {
                return $value->science_branch_id;
            }, $this->scienceDegrees);

            $degreesNewIds = array_map(function ($value)
            {
                return (int)$value['science_branch_id'];
            }, $degrees);

            // update existed degrees
            foreach ($this->scienceDegrees as $degree)
            {
                if (($id = array_search($degree->science_branch_id, $degreesNewIds)) !== false)
                {
                    if ($degree->doctor !== $degrees[$id]['doctor'])
                    {
                        $degree->doctor = $degrees[$id]['doctor'];
                        $degree->update();
                    }
                }
                else
                    $degree->delete();
            }

            // add new degrees
            foreach ($degrees as $degree)
            {
                if (!in_array($degree['science_branch_id'], $degreesOldIds))
                {
                    $newDegree = new ScienceDegree();
                    $newDegree->attributes = $degree;
                    $newDegree->staff_id = $this->id;
                    $newDegree->save();
                }
            }
        }
    }

    /**
     * Delete all science degrees, belonged to this model
     */
    public function deleteScienceDegrees()
    {
        foreach ($this->scienceDegrees as $degree)
            $degree->delete();
    }

    /**
     * Get scienceDegrees as string
     *
     * @return string of links on correspondent science degrees
     */
    public function getScienceDegreesAsString()
    {
        $degrees = array();

        foreach ($this->scienceDegrees as $degree)
            $degrees[] = CHtml::link($degree->getFullTitle(), array(
                'scienceBranch/view',
                'id' => $degree->science_branch_id
            ));

        return implode(', ', $degrees);
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
                                "label" => "Аспиранты",
                                "url" => array(
                                    'candidate/index',
                                    'Candidate[staff_id][]' => $data->id
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