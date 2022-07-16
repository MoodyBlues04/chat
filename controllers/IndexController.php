<?php

namespace app\controllers;

use app\modules\signup\SignupForm;
use Yii;
use yii\web\Controller;
use app\models\Users;

class IndexController extends Controller {

    public $layout = '@app/views/layouts/home.php';

    /**
     * Renders homwpage
     * 
     * @return string
     */
    public function actionIndex() {

        return $this->render('index');
    }

    /**
     * Log in new user
     * 
     * @return string
     */
    public function actionLogin() {

        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            return $this->redirect('index');
        }

        $this->layout = 'login';
        return $this->render('login', ['model' => $model]);
    }

    public function actionSignup() {
        
        $form = new SignupForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            
            return $this->redirect('index');
        }

        $this->layout = 'login';
        return $this->render('signup', ['model' => $form]);
    }
}