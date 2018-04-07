<?php
namespace app\components;

use Yii;
use yii\base\Behavior;
use yii\web\Controller;

class MyBehavior extends Behavior
{
    public $session;
    public $sessAuthority;
    public $localhost;
    
    public function init()
    {
        $this->session = Yii::$app->session;
        $this->sessAuthority = $this->session['authority'];
        $this->localhost = ':8888';
    }
    
    public function isGuest(){
        $authority = $this->session['authority'];
        //echo "Sess Authotiry: " . $authority ."<br>";
        $segment = Yii::$app->controller->id;
        //echo "Segment: " . $segment;
        
        if($authority == null)
        {
            if($segment == 'dashboard')
            {
                return true;
            }
        } else
        {
            return false;
        }
    }
}