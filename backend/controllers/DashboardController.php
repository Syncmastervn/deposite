<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\BehaviModel;


//Use more _ KIEN CODE
use backend\models\User;
use backend\models\Authority;
use backend\models\ProductType;
use backend\models\InvoiceCreate;
use backend\models\DataRun;
use backend\models\SearchInvoice;
use backend\models\Invoice;
use backend\models\InvoiceLimit;
use backend\models\InvoiceUpdate;
use backend\models\CloseInvoiceDate;
use backend\models\UploadImage;
use backend\models\InvoiceLimitDelete;
use backend\models\InvoiceCreateByDate;
use backend\models\Register;
use backend\models\ChangePassword;
use backend\models\Monitor; 
use yii\web\UploadedFile;
/**
 * Site controller
 */
class DashboardController extends Controller
{
    /**
     * @KIEN CODE
     */
    public $variable = '';
    public $sess;
    public $segment;
    public $behavior;
    public $isGuest;
    public $sql;
    public $behav;
    /**
     * @inheritdoc
     */
    public function actions()
    {
        $this->isGuest = $this->behavior->isGuest();
        return [
        'error' => [
            'class' => 'yii\web\ErrorAction',
        ],
        ];
    }
    
    public function init() {
        $this->behavior = new BehaviModel();
        $this->variable = "testing Variable";  
        $this->sess = Yii::$app->session;
        $this->sql = new DataRun();
        $this->behav = new BehaviModel();
        //$this->segment = Yii::$app->controller->id;
    }

    public function authority(){
        $actionActive = Yii::$app->controller->action->id;
        if($actionActive !== 'login' && $this->sess->get('userId') === null)
        {
            $this->redirect(array('site/login'));
            
        }elseif($this->sess->get('userId') !== null)
        {
            
            $token = $this->sql->GetToken($this->sess->get('userId'));
            if($this->sess->get('token') !== $token)
            {
//                echo "Token: " . $token;
//                echo ".|.";
//                echo "Token session: " . $this->sess->get('token');
//                echo ".|.";
//                echo "UserID: " . $this->sess->get('userId');
//                echo ".|.";
//                echo "Test: " . $this->sess->get('test');
                $this->redirect(array('site/login'));
            }   
        }  
    }
    
    public function actionLogout(){
        session_destroy();
        $this->sess->destroy();
        $this->redirect(array('site/login'));
    }
    
    public function actionInvoiceExtend(){
        $request = Yii::$app->request;
        $id = $request->get('id',0);
        if($id != 0)
        {
            $this->sql->UpdateInvoiceLimit($id);

            $param = ['id'=>$id];
            $record = Yii::$app->db->createCommand("SELECT date_on, extended FROM invoice WHERE invoiceID = :id AND status = 1 LIMIT 1",$param)->queryOne();
            
            $hour = 12;
            $get_day= strtotime("today $hour:00");
            $today = date("Y-m-d H:i:s", $get_day);
            
            $invoice_update = Invoice::findOne($id);
            $invoice_update->extended = $record['extended'] + 1;
            $invoice_update->date_update = $today;
            $invoice_update->update();

            $invoice_update = Invoice::findOne($id);
            $invoice_update->date_on = $record['date_on'];
            $invoice_update->update();

            $invoice = Invoice::findOne($id);
            $invoiceLimit = InvoiceLimit::find()
                            ->where(['invoiceID'=>$id])
                            ->andWhere(['status'=>1])
                            ->all();     
            return $this->render('invoice_extend_success',['invoice'=>$invoice,'invoiceLimit'=>$invoiceLimit]);
            
        } else
        {
            $this->redirect(array('site/index'));
        }
    }
    
    // REGISTER 
    public function actionRegister(){
        $request = Yii::$app->request;
        $model = new Register();
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $username = $request->post('Register')['username'];
            $fullname = $request->post('Register')['fullname'];
            $user = User::find()
                    ->where(['userName'=>$username])
                    ->one();
            if($user !== null)
            {
                return $this->render('register',['data'=>1,'model'=>$model,'username'=>$username]);
            } else
            {
                $user = new User();
                $user->userName = $username;
                $user->password = md5($request->post('Register')['password']);
                $user->authID = 2;
                $user->status = 1;
                $user->token = "0";
                $user->fullName = $fullname;
                $user->save();
                $model = new Register();
                return $this->render('register',['data'=>2,'model'=>$model,'username'=>$username]);
            }
        }
        
        return $this->render('register',['model'=>$model,'data'=>0]);
    }
    
    
    // CHANGE PASSWORD
    public function actionChangepassword(){
        $model = new ChangePassword();
        $request = Yii::$app->request;
        $signal = 0;
        //$session = Yii::$app->session;
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $username = $request->post('ChangePassword')['username'];
            $oldpassword = $request->post('ChangePassword')['old_password'];
            $user = User::find()
                    ->where(['userName'=>$username])
                    ->andWhere(['password'=>md5($oldpassword)])
                    ->one();
            if($user === null)
            {
                $signal = -1;
            } else
            {
                $user->password = md5($request->post('ChangePassword')['password']);
                $user->update();
                $signal = 1;
            }
        }
        return $this->render('change-password',['model'=>$model,'signal'=>$signal]);
    }
    
    public function actionInvoiceExtendDelete(){
        $this->authority();
        $model = new InvoiceLimitDelete();
        $request = Yii::$app->request;
        $billcode = null;
        $invoice = null;
        $id = $request->get('id',0);
        if($id === 0)
        {
            if($model->load(Yii::$app->request->post()) && $model->validate())
            {
                $billcode = $request->post('InvoiceLimitDelete')['billcode'];
                $invoice = Invoice::find()
                        ->where(['billCode'=>$billcode])
                        ->one();
                if($invoice === null)
                {
                    $invoice = 0;
                }
            }
        } else
        {
            $this->sql->InvoiceExtendDelete($id);
        }
        return $this->render('invoice_limit_delete',['model'=>$model,'invoice'=>$invoice]);
    }
    
    public function actionInvoiceCloseFromDate(){
        $model = new CloseInvoiceDate();
        $request = Yii::$app->request;
        if($request->post())
        {
            $from_date = $request->post('CloseInvoiceDate')['from_date'];
            $to_date = $request->post('CloseInvoiceDate')['to_date'];
            $model->from_date = $from_date;
            $model->to_date = $to_date;
            
            $params = ['from_date'=>$from_date,'to_date'=>$to_date];
            $records = Yii::$app->db->createCommand("
                SELECT * FROM invoice 
                WHERE date_off >= :from_date 
                AND date_off < :to_date
                ",$params)->queryAll();
            
            return $this->render('close_invoice_date',['model'=>$model,'invoiceLimit'=>$records]);
        } else
        {
            return $this->render('close_invoice_date',['model'=>$model,'invoiceLimit'=>null]);
        }
    }
    
    public function actionInvoiceClose(){
        $request = Yii::$app->request;
        $id = $request->get('id',0);
        if($request->post())
        {
            $idPost = $request->post('InvoiceUpdate')['id'];
            $this->sql->CloseInvoice($idPost);
            return $this->render('close_invoice_success');
        } elseif($id > 0)
        {
            $model = new InvoiceUpdate();
            $invoice = Invoice::findOne($id);
            $model->id = $invoice['invoiceID'];
            $model->billcode = $invoice['billCode'];
            $model->cus_name = $invoice['customerName'];
            $model->cus_mobile = $invoice['cusMobile'];
            $model->deposite = $invoice['deposite_price'];
            $model->description = $invoice['description'];
            
            $invoiceLimit = InvoiceLimit::find()
                            ->where(['invoiceID'=>$id])
                            ->all();
            return $this->render('close_invoice',['invoice'=>$model,'invoiceLimit'=>$invoiceLimit]);
        }
    }
    
    //dashboard/invoice-update
    public function actionInvoiceUpdate(){
        $request = Yii::$app->request;
        $id = $request->get('id',0);
        if($request->post())
        {
            $data = [
                'id'            => $request->post('InvoiceUpdate')['id'],
                'billcode'      => $request->post('InvoiceUpdate')['billcode'],
                'cus_name'      => $request->post('InvoiceUpdate')['cus_name'],
                'cus_mobile'    => $request->post('InvoiceUpdate')['cus_mobile'],
                'cus_address'   => $request->post('InvoiceUpdate')['cus_address'],
                'description'   => $request->post('InvoiceUpdate')['description'],
                'deposite'      => $request->post('InvoiceUpdate')['deposite'],
                'selling'       => $request->post('InvoiceUpdate')['selling'],
                'weight'        => $request->post('InvoiceUpdate')['weight'],
                'weight_total'  => $request->post('InvoiceUpdate')['weight_total']
            ];
            $invoice = Invoice::findOne($data['id']);
            $invoice->billCode      = $data['billcode'];
            $invoice->customerName  = $data['cus_name'];
            $invoice->cusMobile     = $data['cus_mobile'];
            $invoice->cusAddress    = $data['cus_address'];
            $invoice->description   = $data['description'];
            $invoice->deposite_price= $data['deposite'];
            $invoice->selling_price = $data['selling'];
            $invoice->weight_gold   = $data['weight'];
            $invoice->weight_total  = $data['weight_total'];
            if($invoice->update() !== false)
            {
                $model = Invoice::findOne($data['id']);
                return $this->render('update_invoice_success',['model'=>$model]);
            } else
            {
                echo 'Update failed';
            }
        } 
        else if($id != 0)
        {
            $model = new InvoiceUpdate();
            $invoice = Invoice::findOne($id);
            $model->id = $invoice['invoiceID'];
            $model->image = $invoice['image'];
            $model->billcode = $invoice['billCode'];
            $model->cus_name = $invoice['customerName'];
            $model->cus_mobile = $invoice['cusMobile'];
            $model->cus_address = $invoice['cusAddress'];
            $model->description = $invoice['description'];
            $model->deposite = $invoice['deposite_price'];
            $model->selling = $invoice['selling_price'];
            $model->weight = $invoice['weight_gold'];
            $model->weight_total = $invoice['weight_total'];
            $model->extend = $invoice['extended'];
            return $this->render('update_invoice',['model'=>$model]);
        }
        
        
    }
    
    public function actionSearch(){
        $this->authority();
        
        $model = new SearchInvoice();
        $request = Yii::$app->request;
        
        if($model->load(Yii::$app->request->post()) && $model->validate() )
        {
            $data = [
                'cus_name'  => $request->post('SearchInvoice')['cus_name'],
                'mobilde'   => $request->post('SearchInvoice')['mobile'],
                'billcode'  => $request->post('SearchInvoice')['billcode']
            ];
            //var_dump($data);
            echo "<br>";
            if($data['billcode'] != null)
            {
                $result = $this->sql->SearchByBillCode($data['billcode']);
                if($result != null)
                    return $this->render('search_invoice_success',['data'=>$result]);
                else 
                    return $this->render('search_invoice_failed');
            }
        } else
        {
            return $this->render('search_invoice',['model'=>$model]);
        }
        
        
    }
    
    public function actionInvoiceCreate(){
        $model = new InvoiceCreate();
        $request = Yii::$app->request;
        $result = null;
        
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            switch($request->post('InvoiceCreate')['type'])
            {
                case 1:
                    $type = 'Vàng 18k';
                    break;
                case 2:
                    $type = 'Vàng NT';
                    break;
                case 3:
                    $type = 'Vàng 9999 KIMLAN';
                    break;
                case 4:
                    $type = 'Vàng 9999 nhẫn trơn';
                    break;
            }
            
            $data = [
                'billcode'      => $request->post('InvoiceCreate')['billcode'],
                'date_on'       => $request->post('InvoiceCreate')['date_on'] . ' 08:00:00',
                'cus_name'      => $request->post('InvoiceCreate')['cus_name'],
                'cus_mobile'    => $request->post('InvoiceCreate')['cus_mobile'],
                'cus_address'   => $request->post('InvoiceCreate')['cus_address'],
                'deposite'      => $request->post('InvoiceCreate')['deposite'],
                'selling'       => $request->post('InvoiceCreate')['selling'],  
                'weight'        => $request->post('InvoiceCreate')['weight'],
                'weight_total'  => $request->post('InvoiceCreate')['weight_total'],
                'description'   => $request->post('InvoiceCreate')['description'],
                'type'          => $request->post('InvoiceCreate')['type']
            ];

            $result = $this->sql->CreateInvoice($data);

            
            return $this->render('create_invoice_success',[
                'billcode'      => $data['billcode'],
                'cus_name'      => $data['cus_name'],
                'cus_mobile'    => $data['cus_mobile'],
                'cus_address'   => $data['cus_address'],
                'deposite'      => $data['deposite'],
                'weight'        => $data['weight'],
                'selling'       => $data['selling'],
                'weight_total'  => $data['weight_total'],
                'description'   => $data['description'],
                'type'          => $data['type'],
                'id'            => $result                          
            ]);
        } else
        {
            $hour = 8;
            $get_day= strtotime("today $hour:00");
            $today = date("Y-m-d", $get_day);
            $model->date_on = $today;
            return $this->render('create_invoice',['model'=>$model,'result'=>$result]);
        }
        
    }
    
    public function actionInvoiceCreated(){
        $model = new InvoiceCreateByDate();
        $request = Yii::$app->request;
        $invoice = null;
        
        if($model->load(Yii::$app->request->post()) and $model->validate())
        {
            $from_date  = $request->post('InvoiceCreateByDate')['date_begin'];
            $to_date    = $request->post('InvoiceCreateByDate')['date_end'];
            $invoice = Invoice::find()
                        ->where(['>=','date_on', $from_date])
                        ->andWhere(['<=','date_on',$to_date])
                        ->all();
        }
        return $this->render('invoice-created',[
                'model' => $model,
                'invoice'  => $invoice
        ]);
    }
    
    public function actionMonitor(){
        $model = new Monitor();
        
        $hour = 12;
        $get_day= strtotime("today $hour:00");
        $today = date("Y-m-d H:i:s", $get_day);
        $date = strtotime("today");
        $get_date = date("Y-m-d");
        
        
        
        $invoiceUpdate = Invoice::find()
                ->where(['date_update'=>$today])
                ->all();
        
        $invoiceDelete = Invoice::find()
                ->where(['date_off'=>$today])
                ->andWhere(['status'=>0])
                ->all();
        
        $invoiceCreate = Invoice::find()
                ->where(['>=','date_on',$get_date . ' 8:00:00'])
                ->andWhere(['<=','date_on',$get_date . ' 12:00:00'])
                ->all();
                //*** Mr. Nhân do a flavour 
                //->createCommand()->getRawSql();
                //print_r($invoiceDelete);
        
        
        
        return $this->render('monitor',[
            'model'=>$model,
            'invoiceCreate'=>$invoiceCreate,
            'invoiceUpdate'=>$invoiceUpdate,
            'invoiceDelete'=>$invoiceDelete
            ]);
    }    
    
    public function actionUploadImage() 
    {
        $model = new UploadImage();
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $id = $request->post('UploadImage')['id'];
            $file_name = $id . '_' . rand(100, 500);
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->upload($file_name,$id)) {
                // file is uploaded successfully
                echo $request->post('UploadImage')['id'] . "<br>";
                echo "File successfully uploaded";
                $record = Invoice::find()
                        ->select('image')
                        ->where(['invoiceID'=>$id])
                        ->one();
                return $this->render('upload_image_success',['link'=>$this->behav->uploadFolder().$record['image']]);
            }
        } else
        {
            $model->id = Yii::$app->request->get('id',0);
        }
        return $this->render('upload_image', ['model' => $model]);
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
        
    
    /*
    * Tetsing code
    */
    
    public function actionTest(){
//        echo Yii::getAlias('@web') . '/../uploads/' .  $this->behav->uploadFolder();
//        echo "<br>";
//        echo $this->behav->uploadFolder() . 'trungkien.jpg';
        $mydate = "2018-01-14 08:00:00";
        $month = date("m",strtotime($mydate));
        $year = date("y",strtotime($mydate));
        $day = date("d",strtotime($mydate));
        echo $date_c = '20' . $year . '-' . $month . '-' . $day . ' 09:00:00';
        echo '<hr>';
        echo $date_off = strtotime($date_c);
        echo '<br>';
        echo date('Y-m-d H:i:s', $date_off);
        
    }
    
    public function actionTestFiles(){
        //$files=\yii\helpers\FileHelper::findFiles(Yii::getAlias('@app').'/../uploads');
        $files=\yii\helpers\FileHelper::findFiles(Yii::getAlias('@app').'/../uploads',['only'=>['*.png','*.jpg']]);
        $str = $files[0];
        $trim_from = strpos($str,'uploads') + 8;
        $endArray = count($files);
        for($i = 0 ; $i < $endArray ; $i++)
        {
            echo substr($files[$i],$trim_from);
            echo "<br>";
        } 
    }

    
    /*
    * BEHAVIOR testing @KIEN CODE
    */
    public function actionBehavi(){
        $b = new BehaviModel();
        echo $b->authority();
    }
    
    public function actionTwigy()
    {
        $link = "http:/" . Yii::getAlias('@web') . "/index.php?r=dashboard/invoice-extend-delete&id=";
        Yii::$app->controller->renderPartial('partial_view');
        return $this->render('render.twig',[
            'username'  =>'Andie',
            'link'      => $link
            ]);
    }
    
    public function actionDesc(){
        $invoice = Invoice::find()
                ->where(['<=','billCode',100])
                ->orderBy(['invoiceID'=>SORT_DESC])
                ->one();
        var_dump($invoice);
    }
    
    public function actionApi(){
        $request = Yii::$app->request;
        switch($request->get('data'))
        {
            case 'chkBillCode':
                $billcode = $request->get('billcode');
                $dbResult = Invoice::find()
                        ->where(['billCode'=>$billcode])
                        ->andWhere(['status'=>1])
                        ->asArray()
                        ->one();
                if($dbResult != null)
                {
                    echo json_encode($dbResult);
                } else
                {
                    echo 'false';
                }
                break;
        }
    }
    
    public function actionModal(){
        return $this->render('bootstrap-modal');
    }
    
}
