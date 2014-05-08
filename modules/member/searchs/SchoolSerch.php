<?php

namespace app\modules\member\searchs;


use app\modules\member\models\AreaModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\member\models\SchoolModel;

/**
 * SchoolSerch represents the model behind the search form about `app\modules\member\models\SchoolModel`.
 */
class SchoolSerch extends SchoolModel
{
    private static $_area_filter_items = [];
    private static $_area_name_items = [];

    public $keyword;

    public function rules()
    {
        return [
            [['id', 'taxonomy_id'], 'integer'],
            [['name', 'type', 'address', 'email', 'zip_code', 'phone_number', 'create_et', 'update_et'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = SchoolModel::find();

        if (isset($params['SchoolSerch']['keyword'])) {
            $this->keyword = $params['SchoolSerch']['keyword'];
            $query->orFilterWhere(['like', 'name', $this->keyword])
                ->orFilterWhere(['like', 'type', $this->keyword])
                ->orFilterWhere(['like', 'address', $this->keyword])
                ->orFilterWhere(['like', 'email', $this->keyword])
                ->orFilterWhere(['like', 'zip_code', $this->keyword])
                ->orFilterWhere(['like', 'phone_number', $this->keyword]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'taxonomy_id' => $this->taxonomy_id,
            'create_et' => $this->create_et,
            'update_et' => $this->update_et,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'zip_code', $this->zip_code])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number]);

        return $dataProvider;
    }

    public static function loadFilterAreas()
    {
        $type = 'name';
        if (!isset(self::$_area_filter_items[$type])) {
            self::loadFilterAreaItems($type);
        }

        return self::$_area_filter_items[$type];
    }

    private static function loadFilterAreaItems($type)
    {
        self::$_area_filter_items[$type] = [];
        $models = AreaModel::find();
        $models->where(['term_id' => 6]);
        foreach ($models->all() as $model) {
            self::$_area_filter_items[$type][$model->id] = $model->name;
        }
    }


    public static function loadNameAreas()
    {
        $type = 'name';
        if (!isset(self::$_area_name_items[$type])) {
            self::loadNameAreaItems($type);
        }
        return self::$_area_name_items[$type];
    }

    private static function loadNameAreaItems($type)
    {
        self::$_area_name_items[$type] = [];
        $models = AreaModel::find();
        $models->where(['term_id' => 6]);
        foreach ($models->all() as $model) {
            self::$_area_name_items[$type][$model->id] = ucwords($model->name);
        }
    }
}
