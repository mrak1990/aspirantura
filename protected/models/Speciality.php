<?php

/**
 * This is the model class for table "speciality".
 *
 * The followings are the available columns in table 'speciality':
 * @property integer $id
 * @property string $code
 * @property string $title
 * @property integer $science_branch_id
 *
 * The followings are the available model relations:
 * @property ThesisBoard[] $thesisBoards
 * @property scienceBranch $scienceBranch
 * @property Disser[] $dissers
 */
class Speciality extends ActiveRecord
{
    const DELETABLE = false;

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return Speciality the static model class
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
        return 'speciality';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('code, science_branch_id', 'required'),
            array('science_branch_id', 'numerical', 'integerOnly' => true),
            array('code', 'length', 'max' => 8),
            array('title', 'length', 'max' => 200),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, code, title, science_branch_id', 'safe', 'on' => 'search'),
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
            'thesisBoards' => array(self::MANY_MANY, 'ThesisBoard', 'thesis_board_speciality(speciality_id, thesis_board_id)'),
            'scienceBranch' => array(self::BELONGS_TO, 'ScienceBranch', 'science_branch_id'),
            'dissers' => array(self::MANY_MANY, 'Disser', 'disser_speciality(speciality_id, disser_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'code' => 'Шифр',
            'title' => 'Название',
            'science_branch_id' => 'Отрасль науки',
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
        $criteria->compare('code', $this->code, true);
        $criteria->compare('title', $this->title, true);

        if (is_array($this->science_branch_id))
        {
            $this->science_branch_id = array_diff($this->science_branch_id, array(''));
            if (!empty($this->science_branch_id))
                $criteria->addInCondition('science_branch_id', $this->science_branch_id);
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

    /**
     * Get title with short title in braces
     *
     * @return string
     */
    public function getFullTitle()
    {
        return "$this->code ({$this->title})";
    }
}