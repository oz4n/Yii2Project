<?php

namespace app\modules\site\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\modules\site\Site;
use app\modules\site\models\PostModel;
use app\modules\dao\ar\Taxonomy;
use yii\helpers\Html;

/**
 * PostSerch represents the model behind the search form about `app\modules\dao\ar\Post`.
 */
class PostSerch extends PostModel
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
        $query = self::find();
        $query->onCondition([
                    'status' => Site::POST_STATUS_PUBLISH,
                    'type' => Site::POST_POST_TYPE_INFO
                ])
                ->orderBy(['create_et' =>  SORT_DESC])
                ->andFilterWhere(['like', 'other_content', $params['tax']]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 9
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        return $dataProvider;
    }

    public function findPostBySlug($slug)
    {
        if (($model = self::find()->onCondition(['slug' => $slug])->one()) !== null) {
            return $model;
        } else {
            throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function findTaxNameBySLug($slug)
    {
        if (($model = Taxonomy::find()->onCondition(['slug' => $slug])->asArray()->one()) !== null && null != $slug) {
            return $model['name'];
        } else {
            throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function findTaxBySlug($slug){
        if (($model = Taxonomy::find()->onCondition(['slug' => $slug])->one()) !== null && null != $slug) {
            return $model;
        } else {
            throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
        }
    }

    public static function getCategories()
    {
        $models = Taxonomy::find();
        $models->onCondition(['term_id' => Site::WORD_CATEGORY]);
        $data = ArrayHelper::map($models->asArray()->all(), 'id', 'name');
        return $data;
//        return ArrayHelper::merge(['' => $none], $data);
    }

    public static function getTags()
    {
        $models = Taxonomy::find();
        $models->onCondition(['term_id' => Site::WORD_TAG]);
        $data = ArrayHelper::map($models->asArray()->all(), 'id', 'name');
        return $data;
//        return ArrayHelper::merge(['' => $none], $data);
    }
    
    public function getTagLinks($tags)
    {
        $links = [];
        foreach ($tags as $tag){
            $links[] = Html::a(Html::encode("#" . $tag['name']), ['/site/site/tax', 'tax' => $tag['slug']], ["rel" => "tooltip", "data-original-title" => Html::encode("#" . $tag['name'])]);
        }   
        return $links;
    }
    
    public function getAuthorNameById(){
        
    }

}
