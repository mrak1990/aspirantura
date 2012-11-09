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
    const DELETABLE = false;

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
        return array(
            array('email, middle_name', 'default', 'value' => null),
            array('email, first_name, last_name', 'required'),
            array('username', 'required', 'on'=>'changeUsername'),
            array('username', 'length', 'min' => 4, 'max' => 20, 'on'=>'changeUsername'),
            array('password', 'required', 'message' => 'Необходимо ввести пароль.', 'on' => 'insert, newPassword'),
            array('password', 'length', 'min' => 5, 'on' => 'insert, newPassword'),
            array('password2', 'compare', 'compareAttribute' => 'password', 'message' => 'Введённые пароли не совпадают.', 'on' => 'insert'),
            array('email', 'email', 'message' => 'Неверно указан адрес почты.'),
            array('first_name, last_name, middle_name', 'length', 'max' => 30),
            array('username, email', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
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
        $criteria = $this->getDbCriteria();

        $criteria->compare('username', $this->username, true);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('middle_name', $this->middle_name, true);

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

    public function beforeSave()
    {
        if ($this->middle_name === '')
            $this->fio = $this->last_name . ' ' . mb_substr($this->first_name, 0, 1, 'UTF-8') . '.';
        else
            $this->fio = $this->last_name . ' ' . mb_substr($this->first_name, 0, 1, 'UTF-8') . '.' . mb_substr($this->middle_name, 0, 1, 'UTF-8') . '.';

        $this->password_hash = crypt($this->password, Randomness::blowfishSalt());

        return parent::beforeSave();
    }

    public function getFullName()
    {
        return $this->middle_name === ''
            ? $this->last_name . ' ' . $this->first_name
            : $this->last_name . ' ' . $this->first_name . ' ' . $this->middle_name;
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

    static public function getSubModelMenuFunction($size = '')
    {
        return function ($data) use ($size)
        {
            return Yii::app()->controller->widget("ext.bootstrap.widgets.BootButtonGroup", array(
                'size' => $size,
                'buttons' => array(
                    array(
                        'icon' => 'wrench',
                        'items' => array(
                            array(
                                'label' => 'Изменить логин',
                                'url' => array(
                                    'changeUsername',
                                    'id' => $data->id
                                ),
                                'linkOptions' => array(
                                    'title' => 'Изменить имя учётной записи',
                                )
                            ),
                            array(
                                'label' => 'Новый пароль',
                                'url' => array(
                                    'newPassword',
                                    'id' => $data->id
                                ),
                                'linkOptions' => array(
                                    'title' => 'Установить новый пароль',
                                )
                            ),
                        )
                    ),
                ),
            ), true);
        };
    }
}
