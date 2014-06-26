<?php

namespace app\modules\site\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\site\Site;
use app\modules\site\models\GuestbookModel;

/**
 * GuestbookSerch represents the model behind the search form about `app\modules\dao\ar\Guestbook`.
 */
class GuestbookSerch extends GuestbookModel
{

    public function rules()
    {
        return [
            [['id', 'user_id', 'parent_id'], 'integer'],
            [['name', 'email', 'web_site', 'subject', 'content', 'create_at', 'update_et'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = GuestbookModel::find();
        $query->onCondition([
            'status' => Site::GUESTBOOK_PUBLISH_STATUS,
            'parent_id' => null
        ])->orderBy(['create_et' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 6
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }



        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'web_site', $this->web_site])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }

}
