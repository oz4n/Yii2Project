<?php

namespace app\modules\filemanager\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\dao\ar\File;

/**
 * FileManagerSearc represents the model behind the search form about `app\modules\dao\ar\File`.
 */
class FileManagerSearc extends File
{
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['name', 'orginal_name', 'unique_name', 'type', 'size', 'file_type', 'description', 'create_at', 'update_et'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = File::find();        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'create_at' => $this->create_at,
            'update_et' => $this->update_et,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'orginal_name', $this->orginal_name])
            ->andFilterWhere(['like', 'unique_name', $this->unique_name])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'size', $this->size])
            ->andFilterWhere(['like', 'file_type', $this->file_type])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
