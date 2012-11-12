<?php

/**
 * This is the model class for table "thesis_board".
 *
 * The followings are the available columns in table 'thesis_board':
 * @property integer $id
 * @property string $code
 * @property integer $staff_id
 * @property integer $staff2_id
 * @property integer $staff3_id
 *
 * The followings are the available model relations:
 * @property ThesisBoardSpeciality[] $thesisBoardSpecialities
 * @property Staff $staff
 * @property Staff $staff2
 * @property Staff $staff3
 * @property Member[] $members
 * @property Defence[] $defences
 */
class ThesisBoard extends ActiveRecord
{
    const DELETABLE = false;
    public $staff1Fio;

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return ThesisBoard the static model class
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
        return 'thesis_board';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('code, staff_id', 'required'),
            array('staff_id, staff2_id, staff3_id', 'numerical', 'integerOnly' => true),
            array('code', 'length', 'max' => 20),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, code, staff_id, staff2_id, staff3_id', 'safe', 'on' => 'search'),
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
            'thesisBoardSpecialities' => array(self::HAS_MANY, 'ThesisBoardSpeciality', 'thesis_board_id'),
            'staff1' => array(self::BELONGS_TO, 'Staff', 'staff_id'),
            'staff2' => array(self::BELONGS_TO, 'Staff', 'staff2_id'),
            'staff3' => array(self::BELONGS_TO, 'Staff', 'staff3_id'),
            'members' => array(self::HAS_MANY, 'Member', 'thesis_board_id'),
            'membersCount' => array(self::STAT, 'Member', 'thesis_board_id'),
            'defences' => array(self::HAS_MANY, 'Defence', 'thesis_board_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'code' => 'Код',
            'staff1Fio' => 'Председатель',
            'staff_id' => 'Председатель',
            'staff1' => 'Председатель',
            'staff2_id' => 'Заместитель председателя',
            'staff2' => 'Заместитель председателя',
            'staff3_id' => 'Научный секретарь',
            'staff3' => 'Научный секретарь',
            'membersCount' => 'Число членов',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = $this->getDbCriteria();

        $criteria->compare('code', $this->code, true);
        $criteria->compare('staff_id', $this->staff_id);

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

    public function scopes()
    {
        return array(
            'default' => array(
                'with' => array(
                    'staff1',
                    'staff2',
                    'staff3',
                ),
            ),
        );
    }

    /**
     * Update members, belonged to this model
     *
     * @param array $members from $_POST
     */
    public function updateMembers(array $members)
    {
        if ($this->isNewRecord || count($this->members) === 0)
        {
            foreach ($members as $memberData)
            {
                $member = new Member;
                $member->attributes = $memberData;
                $member->thesis_board_id = $this->id;
                $member->save();
            }
        }
        else
        {
            $membersOldIds = array_map(function ($value)
            {
                return $value->staff_id;
            }, $this->members);

            $membersNewIds = array_map(function ($value)
            {
                return (int)$value['staff_id'];
            }, $members);

            // update existed degrees
            foreach ($this->members as $member)
            {
                if (!in_array($member->staff_id, $membersNewIds))
                    $member->delete();
            }

            // add new degrees
            foreach ($members as $member)
            {
                if (!in_array($member['staff_id'], $membersOldIds))
                {
                    $newMember = new Member;
                    $newMember->attributes = $member;
                    $newMember->thesis_board_id = $this->id;
                    $newMember->save();
                }
            }
        }
    }

    /**
     * Delete all science degrees, belonged to this model
     */
    public function deleteMembers()
    {
        foreach ($this->members as $member)
            $member->delete();
    }

    /**
     * Get scienceDegrees as string
     *
     * @return string of links on correspondent science degrees
     */
    public function getMembers()
    {
        $members = array();

        foreach ($this->members as $member)
            $members[] = CHtml::link($member->staff->fio, array(
                'staff/view',
                'id' => $member->staff_id
            ));

        return $members;
    }
}