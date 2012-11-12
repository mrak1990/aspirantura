<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class CandidateStatForm extends CFormModel
{

    public $doctor;
    public $inTime;
    public $done;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            array('doctor, inTime, done', 'boolean'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'doctor' => 'Соискание на',
            'inTime' => 'В течении трёх лет',
            'done' => 'Окончил обучение',
        );
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if ($this->_identity === null)
        {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }

        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE)
        {
            $duration = $this->rememberMe
                // 30 days
                ? 3600 * 24 * 30
                : 0;
            Yii::app()->user->login($this->_identity, $duration);

            return true;
        }
        else
            return false;
    }
}
