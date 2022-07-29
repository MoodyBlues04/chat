<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Logger
 * @package app\models
 *
 * @property int $id
 * @property int $user_id
 * @property string $message
 * @property string $data
 * @property string $created_at
 */
class Logger extends ActiveRecord
{
    public static function primaryKey()
    {
        return 'id';
    }

    public static function getTableName()
    {
        return "{{user}}";
    }

    /**
     * @param string $message
     * @param string $data
     * @param int $user_id
     */
    public function log($message, $data, $user_id = null)
    {
        $this->message = $message;
        $this->data = $data;
        $this->$user_id = $user_id;
        $this->created_at = date('Y-m-d H:i:s');
        return $this->save();
    }
}