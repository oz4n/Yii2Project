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

    public $keyword;

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

        if (isset($params["RuleSerch"]["keyword"])) {
            $query->orFilterWhere(['like', 'description', $params["RuleSerch"]["keyword"]]);
        }

        return $dataProvider;
    }

}
