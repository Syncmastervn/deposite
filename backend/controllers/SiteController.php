<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\BehaviModel;

//Use more _ KIEN CODE
use backend\models\Register;
use backend\models\User;
use backend\models\Authority;
use backend\models\ProductType;
use backend\models\Login;
use backend\models\DataRun;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @KIEN CODE
     */
    public $variable = '';
    public $sess;
    public $actionActive;
    public $localhost;
    public $sql;
    /**
     * @inheritdoc
     */
    public function actions()
    {
        //$this->actionActive = Yii::$app->controller->id;
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
        
    }
    
    public function init() {
        $behav = new BehaviModel();
        $this->variable = $this->actionActive;
        $this->localhost = $behav->localhost;
        $this->sql = new DataRun();
    }

    public function authority(){
        $this->sess = Yii::$app->session;
        $this->actionActive = Yii::$app->controller->action->id;
        $_session = $this->sess['authority'];
        if($this->actionActive != 'login' && $_session == null)
            $this->redirect(array('site/login'));
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $model = new Login();
        $request = Yii::$app->request;
        $username = null;
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $username = $request->post('Login')['username'];
            $password = $request->post('Login')['password'];
            $userId = $this->sql->UserLogin($username,$password);
            if($userId !== false)
            {
                $token = $this->sql->GenToken($userId);
                $this->sess = Yii::$app->session;
                $this->sess->open();
                
                $this->sess->set('userId',$userId); 
                $this->sess->set('token',$token);
                return $this->render('login_success',['username'=>$username]);
            } 
        }
        
        return $this->render('login',[
                'model'=>$model,
                'username' => $username 
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        $this->redirect(array('/site/login'));
        //return $this->goHome();
    }
    
    /*
    * Register admini/manager user
    */
    public function actionRegister(){
        
        //$this->authority();
        
        $model = new Register();
        $request = Yii::$app->request;
        if($model->load(Yii::$app->request->post()) && $model->validate() ) 
        {
            $get = 0;
            $username = $request->post('Register')['username'];
            $result = $this->sql->CheckUser($username);
            if($result)
            {
                echo "User exists";
            } else
            {
                echo "User not exists";
            }
            
//            return $this->render('register',[
//                'model' =>  $model,
//                'login' =>  $get
//            ]);
        } else
        {
            return $this->render('register',[
                'model' =>  $model,
                'login' =>  $this->sess['authority']['login']
            ]);
        }
        
    }
    
    
    /*
    * Tetsing code
    */
    
    public function actionTest(){
        return $this->render('jqueryui');
    }
    
    public function actionDatatable(){
        return $this->render('datatable');
    }
    
    public function actionTestt(){
//        $this->sess = Yii::$app->session;
//        echo "<h2>TESTING</h2>";
//        echo $this->variable;
//        echo "<br>+";
//        echo $this->actionActive;
//        echo "<br>+";
//        echo Yii::$app->controller->action->id;
//        echo "<br><br><h2>Session</h2>" . $this->sess['authority'];
//        echo "URL: "  . $_SERVER['SERVER_NAME'] . $this->localhost . '_'. Yii::getAlias('@web'); 
        echo Yii::$app->params['localing'];
//return $this->render('test.twig',['variable'=>'Kien Mad']);
    }
 
    /*
    * BEHAVIOR testing @KIEN CODE
    */
    public function actionBehavi(){
        $b = new BehaviModel();
        echo $b->userName;
    }

}