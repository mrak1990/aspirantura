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
 * @property Member[] $members
 * @property ThesisBoard[] $thesisBoards
 * @property ThesisBoard[] $thesisBoards1
 * @property ThesisBoard[] $thesisBoards2
 * @property Cite $cite
 * @property Disser[] $dissers
 * @property ScientificDegree[] $scientificDegrees
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
    public $facultyTitle;
    public $departmentTitle;

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
//            'faculty' => array(self::HAS_ONE, 'Faculty', 'faculty_id', 'through' => 'department'),
//            'members' => array(self::HAS_MANY, 'Member', 'staff_id'),
//            'thesisBoards' => array(self::HAS_MANY, 'ThesisBoard', 'staff_id'),
//            'thesisBoards1' => array(self::HAS_MANY, 'ThesisBoard', 'staff2_id'),
//            'thesisBoards2' => array(self::HAS_MANY, 'ThesisBoard', 'staff3_id'),
//            'cite' => array(self::HAS_ONE, 'Cite', 'staff_id'),
//            'dissers' => array(self::MANY_MANY, 'Disser', 'advisor(staff_id, disser_id)'),
//            'scientificDegrees' => array(self::MANY_MANY, 'ScientificDegree', 'staff_scientific_degree(staff_id, scientific_degree_id)'),
            'scientificDegrees' => array(self::HAS_MANY, 'StaffScientificDegree', 'staff_id'),
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
            'facultyTitle' => 'Факультет',
            'facultyId' => 'Факультет',
            'departmentTitle' => 'Кафедра',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('faculty.title', $this->facultyTitle, true);
        $criteria->compare('department.title', $this->departmentTitle, true);
        $criteria->compare('fio', $this->fio, true);
        $criteria->compare('birth', $this->birth, true);
        $criteria->compare('academic_position_id', $this->academic_position_id);
        $criteria->compare('administrative_position_id', $this->administrative_position_id);
        $criteria->compare('scientific_rank_id', $this->scientific_rank_id);

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

    public function resolveSortAttributes()
    {
        return array( //            'staff_id' => 'head',
        );
    }

    public function afterFind()
    {
        if ($this->department !== null)
            $this->facultyId = $this->department->faculty_id;

        foreach ($this->scientificDegrees as $degree)
            $degree->doctor = $degree->doctor ? 1 : 0;

        parent::afterFind();
    }

    public function updateScientificDegrees(array $degrees)
    {
        if ($this->isNewRecord || count($this->scientificDegrees) === 0) {
            foreach ($degrees as $degreeData) {
                $degree = new StaffScientificDegree;
                $degree->attributes = $degreeData;
                $degree->staff_id = $this->id;
                $degree->save();
            }
        } else {
            $degreesOldIds = array_map(function ($value) {
                return $value->scientific_degree_id;
            }, $this->scientificDegrees);

            $degreesNewIds = array_map(function ($value) {
                return $value['scientific_degree_id'];
            }, $degrees);

            foreach ($this->scientificDegrees as $curDegree) {
                if (($id = array_search($curDegree->scientific_degree_id, $degreesNewIds)) !== false) {
                    if ($curDegree->doctor !== $degrees[$id]['doctor']) {
                        $curDegree->doctor = $degrees[$id]['doctor'];
                        $curDegree->update();
                    }
                } else
                    $curDegree->delete();
            }

            foreach ($degrees as $curDegree) {
                if (!in_array($curDegree['scientific_degree_id'], $degreesOldIds)) {
                    $degree = new StaffScientificDegree;
                    $degree->attributes = $curDegree;
                    $degree->staff_id = $this->id;
                    $degree->save();
                }
            }
        }
    }

    public function deleteScientificDegrees()
    {
        foreach ($this->scientificDegrees as $degree)
            $degree->delete();
    }

    public function getScientificDegreesAsString()
    {
        $degrees = array();

        foreach ($this->scientificDegrees as $degree)
            $degrees[] = $degree->getFullTitle();

        return implode(', ', $degrees);
    }
}