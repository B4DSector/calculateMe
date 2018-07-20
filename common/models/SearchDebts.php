<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Debts;

/**
 * SearchDebts represents the model behind the search form of `common\models\Debts`.
 */
class SearchDebts extends Debts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['debt_id', 'user_id', 'contact_id', 'debt_amount', 'debt_tag_id'], 'integer'],
            [['debt_date', 'debt_description'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Debts::find()->where(['user_id' => Yii::$app->user->identity->id]);

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
            // 'debt_id' => $this->debt_id,
            // 'user_id' => $this->user_id,
            // 'contact_id' => $this->contact_id,
            'debt_amount' => $this->debt_amount,
            'debt_date' => $this->debt_date,
            'debt_tag_id' => $this->debt_tag_id,
        ]);

        $query->andFilterWhere(['like', 'debt_description', $this->debt_description]);

        return $dataProvider;
    }
}
