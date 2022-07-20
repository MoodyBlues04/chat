<?php

namespace app\models;

/**
 * Class User
 * @package app\models
 *
 * @property int $id;
 * @property string $username;
 * @property string $password;
 * @property string $email;
 * @property string $confirm_token;
 * @property int $status;
 * 
 * @property string $access_token
 * @property string $auth_key
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const STATUS_DELETED = -1;
    const STATUS_WAIT = 0;
    const STATUS_ACTIVE = 1;

    public function rules()
    {
        return [
            [['username', 'password'], 'required', 'message' => 'please fill in all fields'],
            [ ['password'], 'string', 'min' => 8],
            [['username', 'email'], 'unique'],
            ['status', 'in', 'range' => [self::STATUS_DELETED, self::STATUS_WAIT, self::STATUS_ACTIVE]],
            [['email'], 'email'],
        ];
    }

    public static function getTableName() {
        return "{{user}}";
    }

    /**
     * Finds user by id
     * 
     * @param int $id
     * 
     * @return User 
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds user by access token
     * 
     * @param string $token
     * 
     * @return User 
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * 
     * @return User
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
