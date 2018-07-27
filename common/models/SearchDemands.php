<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Demands;

/**
 * SearchDemands represents the model behind the search form of `common\models\Demands`.
 */
class SearchDemands extends Demands
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['demand_id', 'user_id', 'contact_id', 'demand_amount', 'demand_tag_id'], 'integer'],
            [['demand_date', 'demand_ttg', 'demand_description'], 'safe'],
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
        $query = Demands::find()->where(['user_id' => Yii::$app->user->identity->id]);

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
            // 'demand_id' => $this->demand_id,
            // 'user_id' => $this->user_id,
            //'contact_id' => $this->contact_id,
            'demand_amount' => $this->demand_amount,
            'demand_date' => $this->demand_date,
            'demand_ttg' => $this->demand_ttg,
            'demand_tag_id' => $this->demand_tag_id,
        ]);

        $query->andFilterWhere(['like', 'demand_description', $this->demand_description]);

        return $dataProvider;
    }
}
