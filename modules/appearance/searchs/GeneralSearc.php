<?php

namespace app\modules\appearance\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\dao\ar\Setting;

/**
 * GeneralSearc represents the model behind the search form about `app\modules\dao\ar\Setting`.
 */
class GeneralSearc extends Setting
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['key', 'value', 'name', 'status', 'create_et', 'update_et'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Setting::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'create_et' => $this->create_et,
            'update_et' => $this->update_et,
        ]);

        $query->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
