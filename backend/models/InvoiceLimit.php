<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "invoice_limit".
 *
 * @property int $limitID
 * @property int $invoiceID
 * @property string $date_expands
 * @property string $date_off
 * @property int $userID
 * @property string $descriptions
 * @property int $status
 *
 * @property Invoice $invoice
 * @property User $user
 */
class InvoiceLimit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_limit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoiceID', 'userID'], 'required'],
            [['invoiceID', 'userID', 'status'], 'integer'],
            [['date_expands', 'date_off'], 'safe'],
            [['descriptions'], 'string', 'max' => 200],
            [['invoiceID'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['invoiceID' => 'invoiceID']],
            [['userID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userID' => 'userID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'limitID' => 'Limit ID',
            'invoiceID' => 'Invoice ID',
            'date_expands' => 'Date Expands',
            'date_off' => 'Date Off',
            'userID' => 'User ID',
            'descriptions' => 'Descriptions',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['invoiceID' => 'invoiceID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['userID' => 'userID']);
    }
}
