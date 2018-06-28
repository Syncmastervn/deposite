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
 * @property int $renew_fee
 * @property int $userID
 * @property string $descriptions
 * @property int $status
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
            [['invoiceID', 'renew_fee', 'userID'], 'required'],
            [['invoiceID', 'renew_fee', 'userID', 'status'], 'integer'],
            [['date_expands', 'date_off'], 'safe'],
            [['descriptions'], 'string', 'max' => 200],
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
            'renew_fee' => 'Renew Fee',
            'userID' => 'User ID',
            'descriptions' => 'Descriptions',
            'status' => 'Status',
        ];
    }
}
