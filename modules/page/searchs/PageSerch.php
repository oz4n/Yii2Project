<?php

namespace app\modules\page\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\appearance\models\PageModel;
use app\modules\page\Page;
/**
 * PageSerch represents the model behind the search form about `app\modules\dao\ar\Post`.
 */
class PageSerch extends PageModel
{
    private static $_items = array();
    private static $_list = array(NULL => 'None');

    private $status_filtr1;
    private $status_filtr2;
   

    public $keyword;
    
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['title', 'content', 'type', 'slug', 'status', 'layout', 'image', 'other_content', 'comment_status', 'create_et', 'update_et'], 'safe'],
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
                'type'=>Page::POST_TYPE_PAGE,                
             ]);
        $query->orOnCondition(['type'=>Page::POST_TYPE_PAGE_HELPER]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

       if (isset($params['PageSerch']['status_filtr1'])) {
            $this->status_filtr1 = $params['PageSerch']['status_filtr1'];
             $query->orFilterWhere(['like', 'status', $this->status_filtr1]);
        }

        if (isset($params['PageSerch']['status_filtr2'])) {
            $this->status_filtr2 = $params['PageSerch']['status_filtr2'];
             $query->orFilterWhere(['like', 'status', $this->status_filtr2]);
        }
        
       if (isset($params['PageSerch']['keyword'])) {
            $key = $params['PageSerch']['keyword'];
            $query->orFilterWhere(['like', 'title', $key])
                    ->orFilterWhere(['like', 'content', $key])
                    ->orFilterWhere(['like', 'slug', $key])
                    ->orFilterWhere(['like', 'status', $key])
                    ->orFilterWhere(['like', 'layout', $key])
                    ->orFilterWhere(['like', 'other_content', $key]);
        }
        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'layout', $this->layout])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'other_content', $this->other_content])
            ->andFilterWhere(['like', 'comment_status', $this->comment_status]);

        return $dataProvider;
    }
}
