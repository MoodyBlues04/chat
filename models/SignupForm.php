<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $password;
    public $email;

    public function rules() {
        return [
            [['username', 'password'], 'required', 'message' => 'please fill in all fields'],
            [ ['password'], 'string', 'min' => 8],
            [['username', 'password', 'email'], 'safe'],
            [['email'], 'email'],
        ];
    }

}