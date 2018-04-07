<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $userID
 * @property string $userName
 * @property string $password
 * @property string $fullName
 * @property int $authID
 * @property int $status
 *
 * @property Invoice[] $invoices
 * @property InvoiceLimit[] $invoiceLimits
 * @property Authority $auth
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userName', 'password', 'fullName', 'authID', 'status'], 'required'],
            [['authID', 'status'], 'integer'],
            [['userName', 'fullName'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 150],
            [['authID'], 'exist', 'skipOnError' => true, 'targetClass' => Authority::className(), 'targetAttribute' => ['authID' => 'authID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userID' => 'User ID',
            'userName' => 'User Name',
            'password' => 'Password',
            'fullName' => 'Full Name',
            'authID' => 'Auth ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::className(), ['userID' => 'userID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceLimits()
    {
        return $this->hasMany(InvoiceLimit::className(), ['userID' => 'userID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuth()
    {
        return $this->hasOne(Authority::className(), ['authID' => 'authID']);
    }
}
