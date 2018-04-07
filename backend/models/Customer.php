<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $customerID
 * @property string $fullName
 * @property string $address
 * @property string $userName
 * @property string $password
 * @property string $mobilePhone
 * @property string $email
 * @property string $identity
 * @property string $image
 * @property int $status
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
            [['fullName'], 'required'],
            [['status'], 'integer'],
            [['fullName', 'userName', 'image'], 'string', 'max' => 100],
            [['address', 'password'], 'string', 'max' => 150],
            [['mobilePhone'], 'string', 'max' => 15],
            [['email', 'identity'], 'string', 'max' => 30],
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
            'address' => 'Address',
            'userName' => 'User Name',
            'password' => 'Password',
            'mobilePhone' => 'Mobile Phone',
            'email' => 'Email',
            'identity' => 'Identity',
            'image' => 'Image',
            'status' => 'Status',
        ];
    }
}
