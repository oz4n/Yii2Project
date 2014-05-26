<?php

namespace app\modules\word\searchs;

use app\modules\word\models\CategoryModel;
use app\modules\word\models\TagModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\dao\ar\Post;
use yii\helpers\ArrayHelper;
use app\modules\word\Word;

/**
 * PostSerch represents the model behind the search form about `app\modules\dao\ar\Post`.
 */
class PostSerch extends Post
{
    private static $_items = array();
    private static $_list = array(NULL => 'None');

    private $year_filtr1;
    private $year_filtr2;
    private $year_filtr3;
    private $year_filtr4;
    private $year_opsi;
    private $year_opsi1;

    public $keyword;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'content', 'slug', 'status', 'other_content', 'comment_status', 'create_et', 'update_et'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Post::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'create_et' => $this->create_et,
            'update_et' => $this->update_et,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'other_content', $this->other_content])
            ->andFilterWhere(['like', 'comment_status', $this->comment_status]);

        return $dataProvider;
    }

    public static function getCategories($none = 'None')
    {
        $models = CategoryModel::find();
        $models->onCondition(['term_id' => Word::WORD_CATEGORY]);
        $data = ArrayHelper::map($models->asArray()->all(), 'id', 'name');
        return $data;
//        return ArrayHelper::merge(['' => $none], $data);
    }

    public static function getTags($none = 'None')
    {
        $models = TagModel::find();
        $models->onCondition(['term_id' => Word::WORD_TAG]);
        $data = ArrayHelper::map($models->asArray()->all(), 'id', 'name');
        return $data;
//        return ArrayHelper::merge(['' => $none], $data);
    }
}
