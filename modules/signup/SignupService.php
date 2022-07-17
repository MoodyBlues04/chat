<?php

namespace app\modules\signup;

use Yii;
use app\models\User;
use app\models\SignupForm;
use Exception;

class SignupService
{


    /**
     * Add new user to DB
     * 
     * @param SignupForm $form
     * 
     * @return User
     * @throws Exception
     */
    public function signup($form)
    {
        $user = new User();
        
        $user->name = $form->name;
        $user->password = $form->password;
        $user->email = $form->email;
        $user->email_token = Yii::$app->security->generateRandomString();
        $user->status = User::STATUS_WAIT;

        if (!$user->save()) {
            throw new \Exception("Saving exception.");
        }
        // $user->save(); уже сохраняет в if

        return $user;        
    }

    /**
     * Sent confirm token to user's mail
     * 
     * @param User $user
     * 
     * @throws Exception
     */
    public function sentEmailConfirm($user)
    {
        $email = $user->email;

        $sent = Yii::$app->mailer
            ->compose(
                ['html' => 'signup-comfirm'],
                ['user' => $user])
            ->setTo($email)
            ->setFrom('sokant2005@mail.ru')
            ->setSubject('Confirmation of registration')
            ->send();

        if (!$sent) {
            throw new \Exception('Sending error.');
        }
    }

    /**
     * Validates the token
     * 
     * @param SignupForm $form
     *
     * @throws Exception
     */
    public function confirmation($token): void
    {
        if (empty($token)) {
            throw new \Exception('Empty confirm token.');
        }

        $user = User::findOne(['confirm_token' => $token]);
        if (!$user) {
            throw new \Exception('User is not found.');
        }

        $user->email_confirm_token = null;
        $user->status = User::STATUS_ACTIVE;
        if (!$user->save()) {
            throw new \Exception('Saving error.');
        }

        if (!Yii::$app->getUser()->login($user)){
            throw new \Exception('Error authentication.');
        }
    }
}