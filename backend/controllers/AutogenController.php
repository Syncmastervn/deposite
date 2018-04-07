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

/**
 * Site controller
 */
class AutogenController extends Controller
{
    /**
     * @KIEN CODE
     */
    public $variable;
    public $sess;

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
    public function init() {
        $this->variable = "variableTesting";
        $this->sess = Yii::$app->session;
        $this->sess->open();
        $this->sess['authority'] = [
            'login'     => 0,
            'action'    => null
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index.twig');
    }
    public function actionTest()
    {
        return $this->render('index');
    }
    
    /*
    * AUTO CREATE Authentication, Product_type
    */
    public function actionGen(){
        $record = new Authority;
        $record->authName = "Aministrator";
        $record->status = 1;
        $record->save();
        
        $record = new Authority;
        $record->authName = "Manager";
        $record->status = 1;
        $record->save();
        
        $record = new ProductType;
        $record->name = "Vàng 18k";
        $record->price = 2000000;
        $record->status = 1;
        $record->save();
        
        $record = new ProductType;
        $record->name = "Vàng 99NT";
        $record->price = 3400000;
        $record->status = 1;
        $record->save();
        
        $record = new ProductType;
        $record->name = "Vàng 9999 KIMLAN";
        $record->price = 3500000;
        $record->status = 1;
        $record->save();
        
        $record = new ProductType;
        $record->name = "Vàng 999 nhẫn trơn";
        $record->price = 3300000;
        $record->status = 1;
        $record->save();
        
        $pass = "123456";
        $record = new User;
        $record->userName = "Admin";
        $record->password = md5($pass);
        $record->fullName = "Andie Tran";
        $record->token = md5("token");
        $record->authID = 1;
        $record->status = 1;
        $record->save();

        $record = new User;
        $record->userName = "Manager";
        $record->password = md5($pass);
        $record->token = md5("token");
        $record->fullName = "Andie Tran";
        $record->authID = 2;
        $record->status = 1;
        $record->save();
        
        echo "<h2>Done</h2>";
    }
    
}
