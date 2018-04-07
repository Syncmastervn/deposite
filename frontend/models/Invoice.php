<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property int $invoiceID
 * @property string $billCode
 * @property string $customerName
 * @property string $cusAddress
 * @property string $cusMobile
 * @property string $cusIdentity
 * @property int $userID
 * @property int $deposite_price
 * @property int $selling_price
 * @property int $weight_total
 * @property int $weight_gold
 * @property int $typeID
 * @property string $image
 * @property string $date_on
 * @property string $date_off
 * @property int $price
 * @property int $date_live
 * @property string $description
 * @property int $extended
 * @property int $status
 *
 * @property User $user
 * @property ProductType $type
 * @property InvoiceLimit[] $invoiceLimits
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['billCode', 'customerName', 'cusAddress', 'userID', 'deposite_price', 'selling_price', 'weight_total', 'weight_gold', 'typeID'], 'required'],
            [['userID', 'deposite_price', 'selling_price', 'weight_total', 'weight_gold', 'typeID', 'price', 'date_live', 'extended', 'status'], 'integer'],
            [['date_on', 'date_off'], 'safe'],
            [['billCode', 'customerName', 'image'], 'string', 'max' => 50],
            [['cusAddress'], 'string', 'max' => 100],
            [['cusMobile'], 'string', 'max' => 30],
            [['cusIdentity'], 'string', 'max' => 20],
            [['description'], 'string', 'max' => 200],
            [['userID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userID' => 'userID']],
            [['typeID'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['typeID' => 'typeID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'invoiceID' => 'Invoice ID',
            'billCode' => 'Bill Code',
            'customerName' => 'Customer Name',
            'cusAddress' => 'Cus Address',
            'cusMobile' => 'Cus Mobile',
            'cusIdentity' => 'Cus Identity',
            'userID' => 'User ID',
            'deposite_price' => 'Deposite Price',
            'selling_price' => 'Selling Price',
            'weight_total' => 'Weight Total',
            'weight_gold' => 'Weight Gold',
            'typeID' => 'Type ID',
            'image' => 'Image',
            'date_on' => 'Date On',
            'date_off' => 'Date Off',
            'price' => 'Price',
            'date_live' => 'Date Live',
            'description' => 'Description',
            'extended' => 'Extended',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['userID' => 'userID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ProductType::className(), ['typeID' => 'typeID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceLimits()
    {
        return $this->hasMany(InvoiceLimit::className(), ['invoiceID' => 'invoiceID']);
    }
}
