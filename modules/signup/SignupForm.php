<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model {
    public $name;
    public $password;
    public $email;

    public function rules() {
        return [
            [['name', 'password'], 'required', 'message' => 'please fill in all fields'],
            [ ['password'], 'string', 'min' => 8],
            [['name', 'password'], 'safe'],
            [['name'], 'unique'],
        ];
    }

}