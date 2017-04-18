<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\LearningComment;

/**
 * LearningCommentSearch represents the model behind the search form about `\frontend\models\LearningComment`.
 */
class LearningCommentSearch extends LearningComment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'commenter_id', 'module_id'], 'integer'],
            [['comment', 'learning_status_before', 'learning_status_after'], 'safe'],
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
        $query = LearningComment::find();

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
            ->andFilterWhere(['like', 'learning_status_before', $this->learning_status_before])
            ->andFilterWhere(['like', 'learning_status_after', $this->learning_status_after]);

        return $dataProvider;
    }
}
