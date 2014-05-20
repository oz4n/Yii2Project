<?php

namespace app\modules\filemanager\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\filemanager\models\ImageModel;
use app\modules\filemanager\models\AlbumModel;
use app\modules\filemanager\FileManager;
use yii\helpers\ArrayHelper;
/**
 * ImageSearc represents the model behind the search form about `app\modules\dao\ar\File`.
 */
class ImageSearc extends ImageModel
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
        $query = ImageModel::find();
        $query->onCondition(['type' => FileManager::FILE_TYPE_IMAGE]);
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

    public static function getAlbums($none = 'None')
    {
        $models = AlbumModel::find();
        $models->where(['term_id' => FileManager::FILE_IMAGE_TERM]);
        $data = ArrayHelper::map($models->asArray()->all(), 'id', 'name');
//        return $data;
        return ArrayHelper::merge(['' => $none], $data);
    }

}
