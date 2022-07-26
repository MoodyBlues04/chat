<?php

namespace app\models;

use Yii;
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
 * @property string $image
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
        return "{{user_data}}";
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['auth_key' => 'auth_key']);
    }

    public static function getImgPath()
    {
        $path = __DIR__ . '/../uploads/';

        if (Yii::$app->user->isGuest) {
            return $path . 'guest.png';
        }

        $data = Yii::$app->user->identity->userData;
        if (!is_dir($path)) {
            mkdir($path);
        }

        if (null !== $data->image) {
            $path .= $data->image;
        } else {
            $path .= 'default.png';
        }

        return $path;
    }
}