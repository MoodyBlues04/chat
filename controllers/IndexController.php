<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Users;
use app\models\SignupForm;
use app\modules\signup\SignupService;

class IndexController extends Controller
{

    public $layout = '@app/views/layouts/home.php';

    /**
     * Renders homwpage
     * 
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Log in new user
     * 
     * @return string
     */
    public function actionLogin()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            return $this->redirect('index');
        }

        $this->layout = 'login';
        return $this->render('login', ['model' => $model]);
    }

    public function actionSignup()
    {        
        $form = new SignupForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $service = new SignupService();

            try {
                $user = $service->signup($form);
                Yii::$app->session->setFlash('success', 'Check your email to confirm the registration.');
                $service->sentEmailConfirm($user);
                return $this->redirect('index'); 
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
            
            return $this->redirect('index');
        }

        $this->layout = 'login';
        return $this->render('signup', ['model' => $form]);
    }

    public function actionConfirm($token)
    {
        $service = new SignupService();
    
        try{
            $service->confirmation($token);
            Yii::$app->session->setFlash('success', 'You have successfully confirmed your registration.');
        } catch (\Exception $e){
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
    
        return $this->redirect('index');
    }
}