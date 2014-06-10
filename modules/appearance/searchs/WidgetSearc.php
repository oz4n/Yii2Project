<?php

namespace app\modules\appearance\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\appearance\Appearance;
use app\modules\appearance\models\WidgetModel;


/**
 * WidgetSearc represents the model behind the search form about `app\modules\dao\ar\Widget`.
 */
class WidgetSearc extends WidgetModel
{
    public function rules()
    {
        return [
            [['id', 'position'], 'integer'],
            [['name', 'content', 'status', 'type', 'create_et', 'update_et'], 'safe'],
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

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'position' => $this->position,
            'create_et' => $this->create_et,
            'update_et' => $this->update_et,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }

    public function loadAllDefaultWidget()
    {
        $model = self::find();
        $query = $model->onCondition(['status' => Appearance::APPEARANCE_WIDGET_DEFAULT]);
        return $query->all();
    }

    public function loadAllSidebarWidget()
    {
        $model = self::find();
        $query = $model->onCondition(['layoute_position' => Appearance::APPEARANCE_WIDGET_SIDEBAR_POSITION]);
        return $query->orderBy(['position' => SORT_ASC])->all();
    }

    public function loadAllFooterWidget()
    {
        $model = self::find();
        $query = $model->onCondition(['layoute_position' => Appearance::APPEARANCE_WIDGET_FOOTER_POSITION]);
        return $query->orderBy(['position' => SORT_ASC])->all();
    }


}
