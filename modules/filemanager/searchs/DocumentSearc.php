<?php

namespace app\modules\filemanager\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\filemanager\models\DocumentModel;
use app\modules\filemanager\FileManager;

/**
 * DocumentSearc represents the model behind the search form about `app\modules\dao\ar\File`.
 */
class DocumentSearc extends DocumentModel
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
        $query = self::find();
        $query->onCondition(['type' => FileManager::FILE_TYPE_DOCUMENT])
                ->orderBy(['create_at' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        if (isset($params['DocumentSearc']['keyword'])) {
            $key = $params['DocumentSearc']['keyword'];
            $query->orFilterWhere(['like', 'name', $key])
                    ->orFilterWhere(['like', 'orginal_name', $key])
                    ->orFilterWhere(['like', 'unique_name', $key])
                    ->orFilterWhere(['like', 'type', $key])
                    ->orFilterWhere(['like', 'size', $key])
                    ->orFilterWhere(['like', 'file_type', $key])
                    ->orFilterWhere(['like', 'description', $key]);
        }
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
