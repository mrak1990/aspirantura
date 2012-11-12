<?php

/**
 * This is the model class for table "member".
 *
 * The followings are the available columns in table 'member':
 * @property integer $id
 * @property integer $staff_id
 * @property integer $thesis_board_id
 *
 * The followings are the available model relations:
 * @property Staff $staff
 * @property ThesisBoard $thesisBoard
 */
class Member extends ActiveRecord
{
    const DELETABLE = false;

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return Member the static model class
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
        return 'member';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('staff_id, thesis_board_id', 'required'),
            array('staff_id, thesis_board_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, staff_id, thesis_board_id', 'safe', 'on' => 'search'),
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
            'staff' => array(self::BELONGS_TO, 'Staff', 'staff_id'),
            'thesisBoard' => array(self::BELONGS_TO, 'ThesisBoard', 'thesis_board_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'staff_id' => 'ФИО',
            'thesis_board_id' => 'Диссертационный совет',
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
        $criteria->compare('staff_id', $this->staff_id);
        $criteria->compare('thesis_board_id', $this->thesis_board_id);

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
                    'staff',
                    'thesisBoard',
                ),
            ),
        );
    }
}