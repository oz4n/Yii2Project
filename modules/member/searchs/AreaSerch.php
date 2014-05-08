<?php

namespace app\modules\member\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\member\models\AreaModel;
use yii\helpers\ArrayHelper;

/**
 * AreaSerch represents the model behind the search form about `app\modules\member\models\AreaModel`.
 */
class AreaSerch extends AreaModel
{
    private static $_parent_items = [];
    private static $_parent_list = array(NULL => 'None');
    private static $_name_filter_items = [];
    private static $_parent_filter_items = [];

    public $keyword;

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
        $query = AreaModel::find();
        $query->orderBy([
            'root' => SORT_ASC,
            'lft' => SORT_ASC
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>[
                'pageSize' => 10
            ]
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

        if (isset($params['AreaSerch']['keyword'])) {
            $keyword = $params['AreaSerch']['keyword'];
            $query->orFilterWhere(['like', 'name', $keyword])
                ->orFilterWhere(['like', 'description', $keyword]);
        }

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
        if (!isset(self::$_parent_items[$type])) {
            self::loadParentItems($type);
        }
        return ArrayHelper::merge(self::$_parent_list, self::$_parent_items[$type]);
    }

    private static function loadParentItems($type)
    {
        self::$_parent_items[$type] = [];
        $models = self::find();

//        foreach ($models->all() as $model) {
//            self::$_parent_items[$type][$model->id] = ucwords($model->name);
//        }

        $models->orderBy([
            'root' => SORT_ASC,
            'lft' => SORT_ASC
        ]);
        foreach ($models->all() as $model) {
            if ($model->level == 1) {
                self::$_parent_items[$type][$model->id] = ucwords($model->name);
            } else {
                self::$_parent_items[$type][$model->id] = ucwords(self::getLine($model->level) . $model->name);
            }
        }
    }

    public static function loadFilterParens()
    {
        $type = 'name';
        if (!isset(self::$_parent_filter_items[$type])) {
            self::loadFilterParensItems($type);
        }

        return self::$_parent_filter_items[$type];
    }

    private static function loadFilterParensItems($type)
    {
        self::$_parent_filter_items[$type] = [];
        $models = self::find();
        $models->where(['parent_id' => null]);
        foreach ($models->all() as $model) {
            self::$_parent_filter_items[$type][$model->id] = ucwords($model->name);
        }
    }

    public static function loadFilterNames()
    {
        $type = 'name';
        if (!isset(self::$_name_filter_items[$type])) {
            self::loadFilterNameItems($type);
        }

        return self::$_name_filter_items[$type];
    }

    private static function loadFilterNameItems($type)
    {
        self::$_name_filter_items[$type] = [];
        $models = self::find();
        foreach ($models->all() as $model) {
            self::$_name_filter_items[$type][$model->name] = $model->name;
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
