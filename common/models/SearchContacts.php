<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Contacts;

/**
 * SearchContacts represents the model behind the search form of `common\models\Contacts`.
 */
class SearchContacts extends Contacts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contact_id', 'user_id'], 'integer'],
            [['contact_firstname', 'contact_lastname', 'contact_nickname', 'contact_email', 'contact_phone_number'], 'safe'],
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
        $query = Contacts::find()->where(['user_id' => Yii::$app->user->identity->id]);

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
        // $query->andFilterWhere([
        //     'contact_id' => $this->contact_id,
        //     'user_id' => $this->user_id,
        // ]);

        $query->andFilterWhere(['like', 'contact_firstname', $this->contact_firstname])
            ->andFilterWhere(['like', 'contact_lastname', $this->contact_lastname])
            ->andFilterWhere(['like', 'contact_nickname', $this->contact_nickname])
            ->andFilterWhere(['like', 'contact_email', $this->contact_email])
            ->andFilterWhere(['like', 'contact_phone_number', $this->contact_phone_number]);

        return $dataProvider;
    }
}
