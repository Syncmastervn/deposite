<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $customerID
 * @property string $fullName
 * @property string $userName
 * @property string $password
 * @property string $mobilePhone
 * @property string $email
 * @property string $identityCard
 * @property string $image
 * @property int $status
 *
 * @property Invoice[] $invoices
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fullName', 'status'], 'required'],
            [['status'], 'integer'],
            [['fullName', 'userName', 'image'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 150],
            [['mobilePhone'], 'string', 'max' => 15],
            [['email', 'identityCard'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customerID' => 'Customer ID',
            'fullName' => 'Full Name',
            'userName' => 'User Name',
            'password' => 'Password',
            'mobilePhone' => 'Mobile Phone',
            'email' => 'Email',
            'identityCard' => 'Identity Card',
            'image' => 'Image',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::className(), ['customerID' => 'customerID']);
    }
}
