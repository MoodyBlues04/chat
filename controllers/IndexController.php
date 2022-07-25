<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\SignupForm;
use app\modules\signup\SignupService;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\UserData;

class IndexController extends Controller
{

    public $layout = '@app/views/layouts/home.php';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Renders homepage
     * 
     * @return string
     */
    public function actionIndex()
    {
        return $this->goHome();
    }

    /**
     * Log in user
     * 
     * @return string
     */
    public function actionLogin()
    {
        // if (!Yii::$app->user->isGuest) {
        //     return $this->goHome();
        // }

        $model = new LoginForm();
        
        if ($model->load(Yii::$app->request->post())) {
            try {
                if($model->login()){
                    return $this->goHome();
                } 
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
                return $this->goHome();
            }
        }

        $model->password = '';

        $this->layout = 'login';
        return $this->render('login', [
            'model' => $model
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogOut()
    {
        try {
            Yii::$app->user->logout();
        } catch (\Exception $e) {
            echo $e;
        }
        return $this->goHome();
    }

    /**
     * Sign up new user
     * 
     * @return string
     */
    public function actionSignup()
    {        
        $form = new SignupForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $service = new SignupService();

            try {
                $user = $service->signup($form);
                Yii::$app->session->setFlash('success', 'Check your email to confirm the registration.');
                $service->sentEmailConfirm($user);

                // echo "registered, check email";exit();
                return $this->goHome(); 
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
                
                // echo $e->getMessage();exit();
            }
            
            // echo "how";exit();
            return $this->goHome();
        }

        $this->layout = 'login';
        return $this->render('signup', [
            'model' => $form
        ]);
    }

    /**
     * Verifies confirm token
     * 
     * @return string
     */
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
    
        return $this->goHome();
    }

    public function actionProfile() {

        return $this->render('profile');
    }

    public function actionSettings() {

        return $this->render('settings');
    }

    public function actionEdit() {

        $username = Yii::$app->user->identity->username;
        $user = User::findByUsername($username);
        $model = $user->userData;
        if (null === $model) {
            $model = new UserData();
            $model->auth_key = $user->auth_key;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('./profile');
        }
        return $this->render('edit', [
            'model' => $model
        ]);
    }

    public function goHome() {

        return $this->render('index');
    }

    public function actionTest() {
        echo Yii::$app->user->Identity->username;
        try {
            Yii::$app->user->logout();
        } catch (\Exception $e) {
            echo $e;
        }
    }

}