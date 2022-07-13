<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Users;
use app\models\Login;

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
        $this->layout = false;

        $model = new Login();

        return $this->render('login', [
            'model' => $model
        ]);
    }
}