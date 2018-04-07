<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_type".
 *
 * @property int $typeID
 * @property string $name
 * @property int $price
 * @property string $updateDate
 * @property string $description
 * @property int $status
 *
 * @property Invoice[] $invoices
 */
class ProductType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['price', 'status'], 'integer'],
            [['updateDate'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'typeID' => 'Type ID',
            'name' => 'Name',
            'price' => 'Price',
            'updateDate' => 'Update Date',
            'description' => 'Description',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::className(), ['typeID' => 'typeID']);
    }
}
