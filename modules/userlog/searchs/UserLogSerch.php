<?php

namespace app\modules\userlog\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\dao\ar\UserLog;

/**
 * UserLogSerch represents the model behind the search form about `app\modules\dao\ar\UserLog`.
 */
class UserLogSerch extends UserLog
{
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['create_at', 'url', 'content', 'contry', 'ip_address', 'sistem_oprasi', 'city', 'browser'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = UserLog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'create_at' => $this->create_at,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'contry', $this->contry])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address])
            ->andFilterWhere(['like', 'sistem_oprasi', $this->sistem_oprasi])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'browser', $this->browser]);

        return $dataProvider;
    }
}
