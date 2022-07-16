<?php

namespace app\controllers;

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
            
            return $this->redirect('index/index');
        }

        $this->layout = 'login';
        return $this->render('login', ['model' => $model]);
    }
}