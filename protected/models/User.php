<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'User':
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $fullName
 */
class User extends ActiveRecord
{

    public $password;
    public $password2;

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return User the static model class
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
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email, middle_name', 'default', 'value' => null),
            array('username, password, email, first_name, last_name', 'required', 'message' => 'Необходимо заполнить поле.'),
            array('username, password', 'length', 'min' => 4, 'max' => 20,),
            array('password2', 'compare', 'compareAttribute' => 'password', 'message' => 'Введённые пароли не совпадают.', 'on' => 'insert'),
            array('email', 'email', 'message' => 'Неверно указан адрес.'),
            array('first_name, last_name, middle_name', 'length', 'max' => 20),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('username, password, first_name, last_name, middle_name, full_name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'password2' => 'Повторите пароль',
            'email' => 'Электронная почта',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'fio' => 'ФИО',
            'fullName' => 'ФИО',
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

        $criteria = new CDbCriteria;

        $criteria->compare('username', $this->username, true);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('middle_name', $this->middle_name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function beforeValidate()
    {
        if ($this->middle_name === '')
            $this->fio = $this->last_name . ' ' . mb_substr($this->first_name, 0, 1) . '.';
        else
            $this->fio = $this->last_name . ' ' . mb_substr($this->first_name, 0, 1) . '.' . mb_substr($this->middle_name, 0, 1) . '.';

        return parent::beforeValidate();
    }

    public function beforeSave()
    {
        $this->password_hash = crypt($this->password, Randomness::blowfishSalt());

        return parent::beforeSave();
    }

    public function getFullName()
    {
        if ($this->middle_name === '')
            return $this->last_name . ' ' . $this->first_name;
        else
            return $this->last_name . ' ' . $this->first_name . ' ' . $this->middle_name;
    }

    public static function getAll($userTable)
    {
        $users = array();

        $usersRaw = Yii::app()->db->createCommand()
            ->select('id, username, fio')
            ->from($userTable)
            ->queryAll();
        foreach ($usersRaw as $item)
            $users[$item['id']] = "{$item['username']} ({$item['fio']})";

        return $users;
    }

    protected function afterFind()
    {
        $this->password = '11111';
        $this->password2 = '11111';

        parent::afterFind();
    }
}
