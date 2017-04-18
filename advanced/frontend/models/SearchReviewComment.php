<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ReviewComment;

/**
 * SearchReviewComment represents the model behind the search form about `\frontend\models\ReviewComment`.
 */
class SearchReviewComment extends ReviewComment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'commenter_id', 'module_id'], 'integer'],
            [['comment', 'review_status_before', 'review_status_after'], 'safe'],
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
        $query = ReviewComment::find();

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
            'id' => $this->id,
            'commenter_id' => $this->commenter_id,
            'module_id' => $this->module_id,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'review_status_before', $this->review_status_before])
            ->andFilterWhere(['like', 'review_status_after', $this->review_status_after]);

        return $dataProvider;
    }
}
