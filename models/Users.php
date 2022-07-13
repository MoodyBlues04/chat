<?php

namespace app\models;

use yii\db\ActiveRecord;

class Users extends ActiveRecord {
    
    public function rules(){
        return [
            [['name', 'password'], 'required', 'message' => 'please fill in all fields'],
            [ ['password'], 'string', 'min' => 8],
            ['name', 'password', 'safe'],
            [['name'], 'unique'],
        ];
    }
}