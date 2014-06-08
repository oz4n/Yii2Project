<?php

namespace app\modules\userrbac\search;

use app\modules\userrbac\models\RuleModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\userrbac\UserRbac;

/**
 * RuleSerch represents the model behind the search form about `app\modules\dao\ar\AuthItem`.
 */
class RuleSerch extends RuleModel
{
    public function rules()
    {
        return [
            [['name', 'rule_name', 'description', 'data'], 'safe'],
            [['type', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = self::find();
        $query->onCondition([
            'type' => UserRbac::RBAC_RULE_AKSES_TYPE_GROUP
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'type' => $this->type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'rule_name', $this->rule_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'data', $this->data]);

        return $dataProvider;
    }
}
