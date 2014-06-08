<?php

namespace app\modules\member\searchs;



use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\modules\member\models\SchoolModel;
use app\modules\member\models\AreaModel;


/**
 * SchoolSerch represents the model behind the search form about `app\modules\member\models\SchoolModel`.
 */
class SchoolSerch extends SchoolModel
{
    private static $_area_filter_items = [];
    private static $_items = [];
    private static $_list = [];

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
                ->orFilterWhere(['like', 'create_et', $this->keyword])
                ->orFilterWhere(['like', 'update_et', $this->keyword])
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

        $models = AreaModel::find();
        $models->where(['term_id' => MEMBER_AREA]);
        return ArrayHelper::map($models->asArray()->all(), 'id', 'name');
    }


    public static function getAreas()
    {
        self::getAreaItems();
        return ArrayHelper::merge(self::$_list, self::$_items);
    }

    protected static function getAreaItems()
    {

        $models = AreaModel::find();
        $models->onCondition(['term_id' => MEMBER_AREA]);

//        $models->orderBy([
//            'root' => SORT_ASC,
//            'lft' => SORT_ASC
//        ]);
        $models->where(['term_id' => MEMBER_AREA]);
        foreach ($models->all() as $model) {
            if ($model->level == 1) {
                self::$_items[$model->id] = $model->name;
            } else {
                self::$_items[$model->id] = html_entity_decode(self::getLine($model->level)) . $model->name;
            }
        }
    }

    protected static function getLine($model)
    {
        $line = '';
        for ($i = 0; $i < $model; $i++) {
            $line .= "&nbsp;";
        }
        return $line;
    }
}
