<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use backend\models\ProductType;
use backend\models\Customer;
use backend\models\Invoice;
use backend\models\InvoiceLimit;
use backend\models\User;


class DataRun extends Model
{
    public function CheckUser($userName){
        $record = User::find()
                ->select(['userName'])
                ->where(['userName'=>$userName])
                ->one();
        $result = ($record['userName'] === null)? false : true ;
        return $result;
    }
    
    public function UserLogin($username, $password){
        $record = User::find()
                ->select(['userName','password','userID'])
                ->where(['userName'=>$username])
                ->one();
        if($username === $record['userName'] && md5($password) === $record['password'])
        {
            return $record['userID'];
        } else
        {
            return false;
        }
    }
    
    public function Authority($id)
    {
        $user = User::findOne($id);
        return $user->authID;
    }
    
    public function GenToken($id){
        $token = md5(rand(1000,5000));
        $user = User::findOne($id);
        $user->token = $token;
        $user->update();
        return $token;
    }
    
    public function GetToken($id){
        $record = User::find()
                ->where(['userID'=>$id])
                ->one();
        return $record['token'];
    }
        
    public function SaveFileName($file_name,$id){
        $params = ['id'=>$id];
        $record = Yii::$app->db->createCommand("SELECT date_on FROM invoice WHERE invoiceID = :id",$params)->queryOne();
        
        $invoice = Invoice::findOne($id);
        $invoice->image = $file_name;
        $invoice->update();
        
        $invoice = Invoice::findOne($id);
        $invoice->date_on = $record['date_on'];
        $invoice->update();
    }
        
    public function UpdateInvoiceLimit($id){
        $searching = null;       
        $param = ['id'=>$id];
        $record = Yii::$app->db->createCommand("SELECT * FROM invoice_limit WHERE invoiceID = :id AND status = 1 ORDER BY limitID DESC LIMIT 1",$param)->queryAll();
        foreach($record as $row){
            $searching = $row['limitID'];
            $invoiceLimit_date_off = $row['date_off'];
        }
        if($searching === null or $searching < 1)
        {
            $invoice_find = Invoice::findOne($id);
            $getDate = $invoice_find->date_on;
            $price = $invoice_find->deposite_price;
            //$date_extended =  date('Y-m-d H:i:s', strtotime($getDate. ' + 30 days'));
            $date_extended =  date('Y-m-d H:i:s', strtotime($getDate. ' + 1 months'));  
            

            $invoiceLimit = new InvoiceLimit;
            $invoiceLimit->invoiceID = $id;
            $invoiceLimit->date_off = $date_extended;
            $invoiceLimit->renew_fee = (($price * 3)/100);
            $invoiceLimit->userID = 1;
            $invoiceLimit->status = 1;
            $invoiceLimit->save();
        } elseif($searching > 0)
        {
            $get_date = strtotime($invoiceLimit_date_off);
            $get_date_convert = date('Y-m-d H:i:s',$get_date);
            $add_date = strtotime('+30 day', $get_date);
            $add_date_convert = date('Y-m-d H:i:s',$add_date);
            
            $year = date("y",strtotime($add_date_convert));
            $month = date("m",strtotime($add_date_convert));
            $day = date("d",strtotime($get_date_convert));
            
            $date_string = '20' . $year . '-' . $month . '-' . $day . ' 10:00:00';
            $date_converted = strtotime($date_string);
            
            $invoice = Invoice::findOne($id);
            
            
            $date_off = date('Y-m-d H:i:s', $date_converted);
            $invoiceLimit = new InvoiceLimit;
            $invoiceLimit->invoiceID = $id;
            $invoiceLimit->date_off = $date_off;
            $invoiceLimit->renew_fee = (($invoice->deposite_price*3)/100);
            $invoiceLimit->userID = Yii::$app->session->get('userId');
            $invoiceLimit->save();
        }

    }
    
    public function CloseInvoice($id){
        $params = ['id'=>$id];
        $record = Yii::$app->db->createCommand("
            SELECT date_on 
            FROM invoice 
            WHERE invoiceID = :id
        ",$params)->queryOne();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $minutes = date('m');
        $hour = date('h');
        $get_day= strtotime("today $hour:$minutes:00");
        $today = date("Y-m-d H:i:s", $get_day);
        $invoice = Invoice::findOne($id);
        $invoice->status = 0;
        $invoice->date_off = $today;
        $invoice->update();
        
        $invoice = Invoice::findOne($id);
        $invoice->status = 0;
        $invoice->date_on = $record['date_on'];
        $invoice->update();
        
        InvoiceLimit::updateAll(['status' => 0], ['like','invoiceID',$id]);
    }
    
    public function InsertToProductType(){
        $record = new ProductType;
        $record->name = 'Test01';
        $record->price = 500;
        $record->description = 'Sản phẩm bạc';
        $record->status = 1;
        $record->save();
        $lastId['a'] = Yii::$app->db->getLastInsertID();
        
        $record = new ProductType;
        $record->name = 'Test02';
        $record->price = 500;
        $record->description = 'Sản phẩm bạc';
        $record->status = 1;
        $record->save();
        $lastId['b'] = Yii::$app->db->getLastInsertID();
        
        return $lastId;
    }
    
    public function SearchByBillcode($data){
        $result = Invoice::find()
                    ->where(['billCode'=>$data])
                    ->andWhere(['>=','status',1])
                    ->all();
        return $result;
    }
    
    public function DateLive(){
//        You should change 1 MONTH to 30 DAY:
//
//        WHERE start_date > NOW() - INTERVAL 30 DAY
//        To limit it to 30 days in either direction:
//
//        WHERE start_date > NOW() - INTERVAL 30 DAY
//        AND start_date < NOW() + INTERVAL 30 DAY
        
        //Add thêm ngày cho record . ở đây là thêm 30 ngày 
//        UPDATE credit SET addOns=ADDDATE(addOns, INTERVAL 30 DAY)
//        -- Or
//        UPDATE credit SET addOns=ADDDATE(addOns, 30)
//        UPDATE invoice SET date_on = ADDDATE(date_on,INTERVAL 30 DAY) WHERE invoiceID = 2;

    }
    
        public function CreateInvoice($data){
        $record = new Invoice;
        $record->billCode = $data['billcode'];
        $record->date_on = $data['date_on'];
        $record->customerName = $data['cus_name'];
        $record->cusAddress = $data['cus_address'];
        $record->cusMobile = $data['cus_mobile'];
        $record->userID = 1;//$data['userID'];
        $record->deposite_price = $data['deposite'];
        $record->selling_price = $data['selling'];
        $record->weight_gold = $data['weight'];
        $record->weight_total = $data['weight_total'];
        $record->typeID = $data['type'];
        $record->description = $data['description'];
        $record->date_live = 1;
        $record->extended = 0;
        $record->status = 1;
        $record->save();
        $invoiceId = Yii::$app->db->getLastInsertID();
        return $invoiceId;
    }
    
    public function InvoiceExtendDelete($id){
        $invoice = Invoice::findOne($id);
        $date_on = $invoice->date_on;
        $extended = $invoice->extended;
        $invoice->extended = $extended - 1;
        $invoice->update();

        $invoice = Invoice::findOne($id);
        $invoice->date_on = $date_on;
        $invoice->update();

        $invoiceLimit = InvoiceLimit::find()
                ->where(['invoiceID'=>$id])
                ->orderBy(['limitID'=>SORT_DESC])
                ->one();
        $invoiceLimit->delete();

    }
    
}