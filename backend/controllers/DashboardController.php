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
use backend\models\UserManager;
use backend\models\LimitReducer;
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
    public $egment;
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
            
            $param = ['id'=>$id];
            $invoiceLimit = Yii::$app->db->createCommand("
                SELECT u.userName,  il.date_expands, il.date_off, il.renew_fee
                FROM user AS u INNER JOIN invoice_limit AS il
                ON u.userID = il.userID
                WHERE il.invoiceID = :id;",$param)->queryAll();
            
//            $invoiceLimit = InvoiceLimit::find()
//                            ->where(['invoiceID'=>$id])
//                            ->andWhere(['status'=>1])
//                            ->all();     
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
            $price = $request->post('InvoiceUpdate')['price'];
            $this->sql->CloseInvoice($idPost,$price);
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
        $signal = 0;
        $data_arr = 0;
        $invoiceID[] = 0;
        $invoiceLimit = null;
        if($model->load(Yii::$app->request->post()) && $model->validate() )
        {
            $data = [
                'cus_name'  => $request->post('SearchInvoice')['cus_name'],
                'mobilde'   => $request->post('SearchInvoice')['mobile'],
                'billcode'  => $request->post('SearchInvoice')['billcode']
            ];
            echo "<br>";
            if($data['billcode'] != null)
            {
                $result = $this->sql->SearchByBillCode($data['billcode']);
                if($result != null)
                {
                    $duplicate_result = (count($result)>1) ? true : false ; 
                    $i = 0;
                    foreach($result as $row)
                    {
                        $invoiceID[$i++] = $row['invoiceID'];
                    }
                    $params = ['bc'=>$data['billcode']];
                    $invoiceLimit = Yii::$app->db->createCommand("
                    SELECT i.customerName, i.cusMobile, iL.date_expands, iL.date_off
                    FROM invoice AS i INNER JOIN invoice_limit AS iL
                    ON i.invoiceID = iL.invoiceID
                    WHERE i.status >= 1
                    AND i.billCode = :bc
                    ORDER BY i.customerName
                    ",$params)->queryAll();
                    return $this->render('search_invoice_success',['data'=>$result,'invoiceLimit'=>$invoiceLimit,'duplicate'=>$duplicate_result]);
                } 
                else 
                {
                    $signal = 1;
                    return $this->render('search_invoice',['model'=>$model,'signal'=>$data['billcode']]);
                }
            }
        } else
        {
            return $this->render('search_invoice',['model'=>$model,'signal'=>$signal]);
        }
    }
    
    public function actionInvoiceLose(){
        $request = Yii::$app->request;
        $id = $request->get('id',0);
        if($id != 0)
        {
             date_default_timezone_set('Asia/Ho_Chi_Minh');
            $t=time();
            
            $timestamp = date("Y-m-d h:i:s",$t);
            $params = ['id'=>$id];
            $getDb = Yii::$app->db->createCommand("SELECT date_on, billCode FROM invoice WHERE invoiceID = :id AND status = 1 LIMIT 1",$params)->queryOne();
            
            $invoice = Invoice::findOne($id);
            $invoice->status = 2;
            $invoice->date_lose = $timestamp;
            $invoice->update();
           
            $invoice = Invoice::findOne($id);
            $invoice->date_on = $getDb['date_on'];
           
            $invoice->update();
            
            $message = 'Hoá đơn mã số : ' . $getDb['billCode'] .' đã được đánh dấu ';
            return $this->render('messages',['title' => 'Hoá đơn báo mất', 'message' => $message]);
        }
    }
    
    public function actionInvoiceCreate(){
        $this->authority();
        
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
            
            $invoice_chk = Invoice::find()
                        ->where(['customerName' => $data['cus_name']])
                        ->andWhere(['description' => $data['description']])
                        ->andWhere(['weight_total' => $data['weight_total']])
                        ->one();
            if($invoice_chk === null)
            {
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
                return $this->render('messages',['title' => 'Khoá tạo trùng hoá đơn','message' => 'Hoá đơn đã tạo có nội dung và tên khách hàng giống với hoá đơn có mã số <b>' . $invoice_chk['billCode'] . '</b>']);
            }
            
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
         
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $get_date = Yii::$app->request->post('Monitor')['date_search'];
            $today = $get_date . " 1:00:00";          
        } else
        {
            $hour = 1;
            $get_day= strtotime("today $hour:00");
            $today = date("Y-m-d H:i:s", $get_day);
            $date = strtotime("today");
            $get_date = date("Y-m-d");
        }
    
        $params = ['today'=>$today];
        
        $invoiceUpdate = Yii::$app->db->createCommand("
            SELECT i.extended, iL.limitID, i.deposite_price, i.date_on , i.customerName 
            , iL.invoiceID ,  i.billCode, i.price, iL.userID, iL.renew_fee, iL.status
            , iL.date_expands, iL.date_off
            FROM invoice AS i JOIN invoice_limit AS iL 
            ON i.invoiceID = iL.invoiceID
            WHERE i.date_update >= :today
            AND iL.date_expands >= :today
            AND iL.status = 1;",$params)->queryAll();
        
        $addDate = date('Y-m-d H:i:s',strtotime($today . "+1 days"));
        
        $invoiceDelete = Invoice::find()
                ->where(['>=','date_off',$today])
                ->andWhere(['<=','date_off',$addDate])
                ->andWhere(['status'=>0])
                ->all();

        $invoiceCreate = Invoice::find()
                ->where(['>=','date_on',$get_date . ' 8:00:00'])
                ->andWhere(['<=','date_on',$get_date . ' 13:00:00'])
                ->all();
                //*** Mr. Nhân do a favour 
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
     * Reduce limit extends function
     */
    
    public function actionLimitReducer()
    {
        $model = new LimitReducer(); //This code line dose not use - can be delete ?
        $request = Yii::$app->request;
        $invoice_id = $request->get('invoiceid',0);
        $error = 1;
        if($invoice_id > 0)
        {      
            $params = ['id'=>$invoice_id];
            $record = Yii::$app->db->createCommand("SELECT date_on FROM invoice WHERE invoiceID = :id",$params)->queryOne();
            
            $invoice = Invoice::findOne($invoice_id);
            $invoice->extended = $invoice->extended - 1;
            $invoice->update();
            
            $invoice = Invoice::findOne($invoice_id);
            $invoice->date_on = $record['date_on'];
            $invoice->update();
            
            $iLDelete = InvoiceLimit::find()
                ->where(['invoiceID' => $invoice_id])
                ->orderBy(['limitID' => SORT_DESC])
                ->one();
        
            $iLDelete->delete();
            
            $error = 0;
        } 
        return $this->render('messages',['message' => (($error === 0) ? 'Xoá gia hạn thành công' . ' khách hàng: ' . $invoice->customerName . ' Số lần gia hạn còn lại: ' . $invoice->extended : 'Không thể xoá gia hạn'),'title' => (($error === 0) ? 'Xoá gia hạn hoá đơn: ' . $invoice->billCode : 'Xoá gia hạn xảy ra lỗi')]);
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
//        date_default_timezone_set('Asia/Ho_Chi_Minh');
//        $hour = 1;
//        $get_day= strtotime("today $hour:00");
//        $today = date("Y-m-d H:i:s", $get_day);
//        echo date('d') . '-' . date('m') . '-' . date('Y');
//        $tomorow = date('Y-m-d H:i:s',strtotime($today . "+1 days"));
//        echo '<p>' . $tomorow;
//        echo '<hr>';
//        echo date('h');
//        echo ":" . date('m');
        $iLDelete = InvoiceLimit::find()
                ->where(['invoiceID' => 177])
                ->orderBy(['limitID' => SORT_DESC])
                ->one();
        
        $iLDelete->delete();
        
        $invoiceLimit = InvoiceLimit::find()
                ->where(['invoiceID' => 177])
                ->orderBy(['limitID' => SORT_DESC])
                ->all();
        
        //echo var_dump($invoiceLimit); 
        foreach($invoiceLimit as $row)
        {
            echo $row['invoiceID'] . '-' . $row['renew_fee'] . '<br/>';
        }
        
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
            //http://localhost/deposite/backend/web/index.php?r=dashboard/api&data=chkBillCode&billcode=120
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
    
    public function actionUserManager()
    {
        if($this->sess->get('authId')===1)
        {
            $user = Yii::$app->db->createCommand("
                    SELECT au.authName, u.userName, u.status, u.fullName, u.userID
                    FROM authority AS au INNER JOIN user AS u
                    ON au.authID = u.authID
                    WHERE u.status = 1;
                ")->queryAll();
            return $this->render('user_manager',['user'=>$user]);
        } else
        {
            return $this->render('block-page',['content'=>"Nội dung chỉ hiển thị cho thẩm quyền Quản lý cấp cao !"]);
        }
        
    }
    
    public function actionPopup(){
        $title = "popup";
        $message = "This is message";
        return $this->render('messages',['message'=>$message,'title'=>$title]);
    }
    
    public function actionUserManagerEdit()
    {
        $request = Yii::$app->request;
        $model = new UserManager();
        $id = $request->get('id',0);
        if($request->post())
        {
            echo "This is post";
            $user = User::findOne($request->post('UserManager')['userID']);
            $user->userName = $request->post('UserManager')['userName'];
            $user->authID = (int)$request->post('UserManager')['authName'];
            $user->password = md5($request->post('UserManager')['password']);
            if(!$user->update())
            {
                echo "<p>_failed";
            }
            else
            {
                return $this->render('messages',[
                    'message'=>'Thay đổi thành công',
                    'title'=>'Manager Edit'
                    ]);
            }
        } else
        {
           $params = ['id'=>$id];

            $query = Yii::$app->db->createCommand("
                    SELECT au.authName, u.userName, u.status, u.fullName, u.userID, u.password
                    FROM authority AS au INNER JOIN user AS u
                    ON au.authID = u.authID
                    WHERE u.userID = :id;
                ",$params)->queryOne();
            $model->userID = $query['userID'];
            $model->userName = $query['userName'];
            $model->authName = $query['authName'];
            $model->password = $query['password'];
            $model->fullName = $query['fullName']; 
            return $this->render('user_manager_edit',['model'=>$model]);
        }
    }
    
    public function actionModal(){
        //return $this->render('bootstrap-modal');
        echo "hello";
    }
    
    public function actionSendMail(){
        return Yii::$app->mailer->compose()
                ->setFrom('trungkien.kimlan@gmail.com')
                ->setTo('trung-kien@hotmail.com')
                ->setSubject('Yii2 test push notification')
                ->setTextBody('This is content Body')
                ->send();
    }
    
    public function actionSqltest() {
//        $inv_limit = InvoiceLimit::find()
//                    ->where(['invoiceID' => 8])
//                    ->all();
//        echo ("this is demo <br>");
//        $result = $this->sql->SearchByBillCode(96);
//        echo (count($inv_limit));
//       date_default_timezone_set('Asia/Ho_Chi_Minh');
//        $t=time();
//    echo($t . "<br>");
//    echo(date("Y-m-d h:i:s",$t));
//    echo "<br>";
//    echo date_default_timezone_get();
//        $invoice = Invoice::find()
//                ->select(['invoice.billCode','invoice_limit.invoiceID','invoice.extended','invoice.customerName','invoice_limit.date_expands'])
//                ->innerJoin('invoice_limit','invoice_limit.invoiceID = invoice.invoiceID')
//                ->where(['>=','invoice.status',1])
//                ->all();
        
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $minutes = date('i');
        $hour = date('h');
        $get_day= strtotime("today $hour:$minutes:00");
        echo (date("Y-m-d h:i:s",$get_day));
                
    }
}
