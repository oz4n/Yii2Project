<?php

namespace app\modules\member\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\member\models\LifeSkillModel;
use yii\helpers\ArrayHelper;

/**
 * LifeSkillSerch represents the model behind the search form about `app\modules\member\models\LifeSkillModel`.
 */
class LifeSkillSerch extends LifeSkillModel
{

    private static $_items = array();
    private static $_list = array(NULL => 'None');

    public function rules()
    {
        return [
            [['id', 'parent_id', 'term_id', 'position', 'lft', 'rgt', 'root', 'level'], 'integer'],
            [['name', 'description', 'count', 'slug', 'status', 'create_et', 'update_et'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = LifeSkillModel::find();
        $query->where(['term_id' => 1]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->orderBy([
            'root' => SORT_ASC,
            'lft' => SORT_ASC
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'term_id' => $this->term_id,
            'position' => $this->position,
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'root' => $this->root,
            'level' => $this->level,
            'create_et' => $this->create_et,
            'update_et' => $this->update_et,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'count', $this->count])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

    public static function loadParents()
    {
        $type = 'name';
        if (!isset(self::$_items[$type])) {
            self::loadParentItems($type);
        }

        return ArrayHelper::merge(self::$_list, self::$_items[$type]);
    }

    private static function loadParentItems($type)
    {
        self::$_items[$type] = array();
        $models = LifeSkillModel::find();
        $models->where(['term_id' => 1]);
        $models->orderBy([
            'root' => SORT_ASC,
            'lft' => SORT_ASC
        ]);
        foreach ($models->all() as $model) {
            if ($model->level == 1) {
                self::$_items[$type][$model->id] = ucwords($model->name);
            } else {
                self::$_items[$type][$model->id] = ucwords(self::getLine($model->level) . $model->name);
            }
        }

    }

    private static function getLine($model)
    {
        $line = '';
        for ($i = 0; $i < $model; $i++) {
            $line .= "- ";
        }
        return $line;
    }

}
