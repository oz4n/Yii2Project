<?php

namespace app\modules\member\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\modules\member\models\LanguageSkillModel;

/**
 * LanguageSkillSerch represents the model behind the search form about `app\modules\member\models\LanguageSkillModel`.
 */
class LanguageSkillSerch extends LanguageSkillModel
{
    private static $_parent_items = [];
    private static $_parent_list = ['' => 'None'];
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
        $query = self::find();
        $query->onCondition(['term_id' => MEMBER_LANG_SKILL]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ]
        ]);

//        $query->orderBy([
//            'root' => SORT_ASC,
//            'lft' => SORT_ASC
//        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if (isset($params['LanguageSkillSerch']['keyword'])) {
            $this->keyword = $params['LanguageSkillSerch']['keyword'];
            $query->orFilterWhere(['like', 'name', $this->keyword]);
            $query->orFilterWhere(['like', 'description', $this->keyword]);
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'parent_id', $this->parent_id]);
        return $dataProvider;

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
        $models->where(['term_id' => MEMBER_LANG_SKILL]);
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
        $models->where(['parent_id' => null, 'term_id' => MEMBER_LANG_SKILL]);
        return ArrayHelper::map($models->asArray()->all(), 'id', 'name');
    }


    public static function getFilterNames()
    {
        $models = self::find();
        $models->where(['term_id' => MEMBER_LANG_SKILL]);
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
