<?php

namespace app\controllers;

use yii\web\Controller;

class TmpController extends Controller {

    public function actionSay() {
        echo "<pre>";
        for ($i = 0; $i < 100; $i++) {
            echo "hi" * 100 . PHP_EOL;
        }
        echo "</pre>";
    }
}