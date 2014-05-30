<?php

namespace app\modules\filemanager\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\dao\ar\Taxonomy;

/**
 * AlbumSearc represents the model behind the search form about `app\modules\dao\ar\Taxonomy`.
 */
class AlbumSearc extends Taxonomy
{
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
        $query = Taxonomy::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'term_id' => $this->term_id,
            'count' => $this->count,
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
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
