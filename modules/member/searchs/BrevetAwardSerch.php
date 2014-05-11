<?php

namespace app\modules\member\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\modules\member\models\BrevetAwardModel;

/**
 * BrevetAwardSerch represents the model behind the search form about `app\modules\member\models\BrevetAwardModel`.
 */
class BrevetAwardSerch extends BrevetAwardModel
{
    private static $_parent_items = [];
    private static $_parent_list = ['' => 'None'];
    public $keyword;

    public function rules()
    {
        return [
            [['id', 'parent_id', 'term_id', 'count', 'position', 'lft', 'rgt', 'root', 'level'], 'integer'],
            [['name', 'description', 'slug', 'status', 'create_et', 'update_et'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = BrevetAwardModel::find();
        $query->where(['term_id' => MEMBER_BREVET]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if (isset($params['BrevetAwardSerch']['keyword'])) {
            $this->keyword = $params['BrevetAwardSerch']['keyword'];
            $query->andFilterWhere(['like', 'name', $this->keyword]);
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

    public static function getParents()
    {
        self::getParentItems();
        return ArrayHelper::merge(self::$_parent_list, self::$_parent_items);
    }

    private static function getParentItems()
    {
        $models = self::find();
//        $models->orderBy([
//            'root' => SORT_ASC,
//            'lft' => SORT_ASC
//        ]);
        $models->where(['term_id' => MEMBER_BREVET]);
        foreach ($models->all() as $model) {
            if ($model->level == 1) {
                self::$_parent_items[$model->id] = $model->name;
            } else {
                self::$_parent_items[$model->id] = html_entity_decode(self::getLine($model->level)) . $model->name;
            }
        }
    }

    public static function getFilterParens()
    {
        $models = self::find();
        $models->where(['parent_id' => null, 'term_id' => MEMBER_BREVET]);
        return ArrayHelper::map($models->asArray()->all(), 'id', 'name');
    }


    public static function getFilterNames()
    {
        $models = self::find();
        $models->where(['term_id' => MEMBER_BREVET]);
        return ArrayHelper::map($models->asArray()->all(), 'name', 'name');
    }


    private static function getLine($model)
    {
        $line = '';
        for ($i = 0; $i < $model; $i++) {
            $line .= "&nbsp;";
        }
        return $line;
    }
}
