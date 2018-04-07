<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "authority".
 *
 * @property int $authID
 * @property string $authName
 * @property string $keyLog
 * @property string $descriptions
 * @property string $setDate
 * @property int $status
 *
 * @property User[] $users
 */
class Authority extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'authority';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['authName', 'status'], 'required'],
            [['setDate'], 'safe'],
            [['status'], 'integer'],
            [['authName', 'descriptions'], 'string', 'max' => 200],
            [['keyLog'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'authID' => 'Auth ID',
            'authName' => 'Auth Name',
            'keyLog' => 'Key Log',
            'descriptions' => 'Descriptions',
            'setDate' => 'Set Date',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['authID' => 'authID']);
    }
}
