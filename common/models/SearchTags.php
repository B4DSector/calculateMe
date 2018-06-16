<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tags;

/**
 * SearchTags represents the model behind the search form of `common\models\Tags`.
 */
class SearchTags extends Tags
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tag_id', 'user_id'], 'integer'],
            [['tag_name', 'tag_description'], 'safe'],
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
        $query = Tags::find()->where(['user_id' => Yii::$app->user->identity->id]);

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
            // 'tag_id' => $this->tag_id,
            // 'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'tag_name', $this->tag_name])
            ->andFilterWhere(['like', 'tag_description', $this->tag_description]);

        return $dataProvider;
    }
}
