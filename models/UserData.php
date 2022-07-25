<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class UserData
 * @package app\models
 *
 * @property int $id
 * @property string $auth_key
 * @property string $name
 * @property string $surname
 * @property string $gender
 * @property string $introduction
 */
class UserData extends ActiveRecord
{
    const GENDER_MALE = 0;
    const GENDER_FEMALE = 1;
    const GENDER_ATTACK_HELICOPTER = 2;

    public function rules()
    {
        return [
            [['auth_key'], 'required'],
            ['gender', 'in', 'range' => [self::GENDER_MALE, self::GENDER_FEMALE, self::GENDER_ATTACK_HELICOPTER]],
            [['name', 'surname', 'gender', 'introduction'], 'safe'],
        ];
    }

    public static function getTableName() {
        return "{{user}}";
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['auth_key' => 'auth_key']);
    }
}