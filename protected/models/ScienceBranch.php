<?php

/**
 * This is the model class for table "science_branch".
 *
 * The followings are the available columns in table 'science_branch':
 * @property integer $id
 * @property string $title
 * @property string $full_title
 * @property string $full_title_nom
 *
 * The followings are the available model relations:
 * @property Speciality[] $specialities
 * @property Staff[] $staffs
 */
class ScienceBranch extends ActiveRecord
{
    const DELETABLE = false;

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return ScienceBranch the static model class
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
        return 'science_branch';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('title, full_title_nom', 'required'),
            array('title', 'length', 'max' => 25),
            array('full_title, full_title_nom', 'length', 'max' => 50),
            array('id, full_title_nom', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'specialities' => array(self::HAS_MANY, 'Speciality', 'science_branch_id'),
            'staffs' => array(self::MANY_MANY, 'Staff', 'science_degree(science_branch_id, staff_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Краткое название (в родительном падеже)',
            'full_title' => 'Название (в родительном падеже)',
            'full_title_nom' => 'Название',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = $this->getDbCriteria();

        $criteria->compare('full_title_nom', $this->full_title_nom, true);

        return $this;
    }

    public function behaviors()
    {
        return array(
            'SortingBehavior' => array(
                'class' => 'application.components.behaviors.SortingBehavior',
            ),
        );
    }

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
                                'label' => 'Специальности',
                                'url' => array(
                                    'speciality/index',
                                    'Speciality[science_branch_id][]' => $data->id
                                ),
                                'linkOptions' => array(
                                    'title' => 'Специальности по отрасли науки',
                                )
                            ),
                        )
                    ),
                ),
            ), true);
        };
    }
}