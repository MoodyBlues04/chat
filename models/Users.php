<?php

namespace app\models;

use yii\db\ActiveRecord;

class Users extends ActiveRecord {
    const STATUS_DELETED = -1;
    const STATUS_WAIT = 0;
    const STATUS_ACTIVE = 1;
    
    public function rules() {
        return [
            [['name', 'password'], 'required', 'message' => 'please fill in all fields'],
            [ ['password'], 'string', 'min' => 8],
            [['name', 'password'], 'safe'],
            [['name', 'email'], 'unique'],
            ['status', 'in', 'range' => [self::STATUS_DELETED, self::STATUS_WAIT, self::STATUS_ACTIVE]],
            [['email'], 'email'],
        ];
    }
}