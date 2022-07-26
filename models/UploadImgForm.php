<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadImgForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    // public function rules()
    // {
    //     return [
    //         [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => ['png', 'jpg']],
    //     ];
    // }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs(__DIR__ . '/../uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}