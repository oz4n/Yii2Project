<?php

namespace app\modules\member\models\search;

//use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\member\models\ProvinceModel;
use yii\helpers\ArrayHelper;

/**
 * ProvinceSerch represents the model behind the search form about `app\modules\dao\ar\Province`.
 */
class ProvinceSerch extends ProvinceModel
{

    private static $_items = [];
    private static $_list = array(NULL => 'None');
    private static $_name_filter_items = [];
    private static $_parent_filter_items = [];

    public $keyword;


    public function rules()
    {
        return [
            [['id', 'parent_id'], 'integer'],
            [['name', 'type', 'create_et', 'update_et'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {


        $query = ProvinceModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if (isset($params['ProvinceSerch']['keyword'])) {
            $keyword = $params['ProvinceSerch']['keyword'];
            $query->orFilterWhere(['like', 'type', $keyword])
                ->orFilterWhere(['like', 'name', $keyword]);
        }
        $query->orFilterWhere(['like', 'name', $this->name])
            ->orFilterWhere(['like', 'type', $this->type]);

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
        self::$_items[$type] = [];
        $models = ProvinceModel::find();
        foreach ($models->all() as $model) {
            self::$_items[$type][$model->id] = ucwords($model->name);
        }
    }

    public static function loadFilterParens()
    {
        $type = 'name';
        if (!isset(self::$_parent_filter_items[$type])) {
            self::loadFilterParensItems($type);
        }

        return self::$_parent_filter_items[$type];
//        return ArrayHelper::merge([0=>'(not set)'], self::$_parent_filter_items[$type]);
    }

    private static function loadFilterParensItems($type)
    {
        self::$_parent_filter_items[$type] = [];
        $models = ProvinceModel::find();
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
        $models = ProvinceModel::find();
        foreach ($models->all() as $model) {
            self::$_name_filter_items[$type][$model->name] = ucwords($model->name);
        }
    }

}
