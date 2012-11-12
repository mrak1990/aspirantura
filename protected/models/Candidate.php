<?php

/**
 * This is the model class for table "candidate".
 *
 * The followings are the available columns in table 'candidate':
 * @property integer $id
 * @property integer $department_id
 * @property string $fio
 * @property string $birth
 * @property boolean $doctor
 * @property string $enter
 * @property string $done
 * @property integer $speciality_id
 *
 * The followings are the available model relations:
 * @property Disser $disser
 */
class Candidate extends ActiveRecord
{
    const DELETABLE = false;
    public $facultyId;
    public $disserTitle;
    public $doctor;
    public $done = '0';

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
        return array(
            array('birth, done_date, done, doctor', 'default', 'value' => null),
            array('fio, department_id, speciality_id, staff_id, enter', 'required'),
            array('department_id, speciality_id, staff_id', 'numerical', 'integerOnly' => true),
            array('fio', 'length', 'max' => 50),
            array('doctor, done', 'boolean'),
            array('birth, enter, done_date', 'date', 'format' => 'dd.MM.yyyy'),
            array('id, doctor, facultyId, department_id, fio, birth, disserTitle, is_postgrad, speciality_id', 'safe', 'on' => 'search'),
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
            'disser' => array(self::HAS_ONE, 'Disser', 'candidate_id'),
            'speciality' => array(self::BELONGS_TO, 'Speciality', 'speciality_id'),
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
            'enter' => 'Дата зачисления',
            'done_date' => 'Дата отчисления',
            'done' => 'Окончил',
            'staff_id' => 'Научный руководитель',
            'birth' => 'Дата рождения',
            'disserTitle' => 'Тема диссертации',
            'doctor' => 'Степень',
            'doctorLong' => 'Степень',
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
        $criteria = $this->getDbCriteria();

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.fio', $this->fio, true);

        if (isset($this->doctor))
            $criteria->compare('t.doctor', $this->doctor === '1'
                    ? true
                    : false
            );

        $criteria->compare('disser.title', $this->disserTitle, true);
        $criteria->compare('t.staff_id', $this->staff_id);

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
            {
                $criteria->addInCondition('department.faculty_id', $this->facultyId);
            }
        }

        if (is_array($this->speciality_id))
        {
            $this->speciality_id = array_diff($this->speciality_id, array(''));
            if (!empty($this->speciality_id))
                $criteria->addInCondition('t.speciality_id', $this->speciality_id);
        }

        return $this;
    }

    public function behaviors()
    {
        return array(
            'SortingBehavior' => array(
                'class' => 'application.components.behaviors.SortingBehavior',
            )
        );
    }

    /**
     * Update disser
     *
     * @param array $disser from $_POST
     */
    public function updateDisser(array $disserPOST)
    {
        if ($this->disser === null)
        {
            $disser = new Disser;
            $disser->candidate_id = $this->id;
            $disser->attributes = $disserPOST;
            $disser->save();
        }
        else
        {
            $disser = $this->disser;
            $disser->attributes = $disserPOST;
            $disser->save();
        }
    }

    /**
     * Delete disser
     *
     * @param array $disser from $_POST
     */
    public function deleteDisser()
    {
        $disser = $this->disser;
        if ($disser !== null)
            $disser->delete();
    }

    /**
     * @return array for CSort->attributes
     */
    public function getSortAttributes()
    {
        return array(
            'advisor' => array(
                'asc' => 'advisor.fio',
                'desc' => 'advisor.fio DESC',
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
            'staff_id' => 'advisor',
        );
    }

    public function getDoctorLong()
    {
        return $this->doctor
            ? 'Доктор'
            : 'Кандидат';
    }

    public function beforeSave()
    {
        $this->doctor = $this->doctor === '1'
            ? true
            : false;

        return parent::beforeSave();
    }

    public function afterFind()
    {
        $this->doctor = $this->doctor === true
            ? '1'
            : '0';
    }

//    public function getCount($doctor)
//    {
//        return Yii::app()->db->createCommand()
//            ->select('COUNT(*) as count')
//            ->where("doctor = {$doctor}")
//            ->from($this->tableName())
//            ->queryScalar();
//    }

    public function scopes()
    {
        return array(
            'default' => array(
                'with' => array(
                    'department' => array(
                        'with' => array(
                            'faculty'
                        ),
                    ),
                    'advisor',
                    'disser',
                ),
                'scopes' => $this->done === '1'
                    ? 'done'
                    : 'undone',
            ),
            'done' => array(
                'condition' => 'done_date IS NOT NULL',
            ),
            'undone' => array(
                'condition' => 'done_date IS NULL',
            ),
            'inTime' => array(
                'condition' => "coalesce(done_date, current_date) <= enter + interval '3 year'",
            ),
            'notInTime' => array(
                'condition' => "coalesce(done_date, current_date) > enter + interval '3 year'",
            ),
            'doctor' => array(
                'condition' => 'doctor = true',
            ),
            'notDoctor' => array(
                'condition' => 'doctor = false',
            ),
        );
    }

    public function getDoneScope()
    {
        $done = $this->done;
        if (is_array($done))
        {
            if (in_array('0', $done) && in_array('1', $done))
                return null;
            elseif (in_array('0', $done))
                return 'undone';
            else
                return 'done';
        }
        else
            return null;
    }
}