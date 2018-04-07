<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $userID
 * @property string $userName
 * @property string $password
 * @property string $fullName
 * @property int $authID
 * @property string $token
 * @property int $status
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
            [['userName', 'password', 'fullName', 'authID'], 'required'],
            [['authID', 'status'], 'integer'],
            [['userName', 'fullName', 'token'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 150],
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
            'token' => 'Token',
            'status' => 'Status',
        ];
    }
}
