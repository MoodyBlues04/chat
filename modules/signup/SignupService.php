<?php

namespace app\modules\signup;

use Yii;
use app\models\Users;

class SignupService {

    public function signup($form) {
        $user = new Users();
        
        $user->name = $form->name;
        $user->password = $form->password;
        $user->email = $form->email;
        $user->email_token = Yii::$app->security->generateRandomString();
        $user->status = Users::STATUS_WAIT;

    }
}