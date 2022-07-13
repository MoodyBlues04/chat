<?php

namespace app\controllers;

use yii\web\Controller;

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

    }
}