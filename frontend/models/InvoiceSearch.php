<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Invoice;

/**
 * InvoiceSearch represents the model behind the search form of `app\models\Invoice`.
 */
class InvoiceSearch extends Invoice
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoiceID', 'customerID', 'userID', 'deposite_price', 'selling_price', 'weight_total', 'date_live', 'extended', 'status'], 'integer'],
            [['date_on', 'date_off'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Invoice::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'invoiceID' => $this->invoiceID,
            'customerID' => $this->customerID,
            'userID' => $this->userID,
            'deposite_price' => $this->deposite_price,
            'selling_price' => $this->selling_price,
            'weight_total' => $this->weight_total,
            'date_on' => $this->date_on,
            'date_off' => $this->date_off,
            'date_live' => $this->date_live,
            'extended' => $this->extended,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
