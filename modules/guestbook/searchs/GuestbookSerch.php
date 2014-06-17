<?php

namespace app\modules\guestbook\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\dao\ar\Guestbook;

/**
 * GuestbookSerch represents the model behind the search form about `app\modules\dao\ar\Guestbook`.
 */
class GuestbookSerch extends Guestbook
{

    private $status_filtr1;
    private $status_filtr2;
    public $keyword;

    public function rules()
    {
        return [
            [['id', 'user_id', 'parent_id'], 'integer'],
            [['name', 'email', 'web_site', 'subject', 'content', 'create_et', 'update_et'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Guestbook::find();
        $query->onCondition(['parent_id' => null]);
        $query->orderBy([
            'status' => SORT_DESC,
            'create_et' => SORT_DESC,
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        if (isset($params['GuestbookSerch']['status_filtr1'])) {
            $this->status_filtr1 = $params['GuestbookSerch']['status_filtr1'];
             $query->orFilterWhere(['like', 'status', $this->status_filtr1]);
        }

        if (isset($params['GuestbookSerch']['status_filtr2'])) {
            $this->status_filtr2 = $params['GuestbookSerch']['status_filtr2'];
             $query->orFilterWhere(['like', 'status', $this->status_filtr2]);
        }

        if (isset($params['GuestbookSerch']['keyword'])) {
            $key = $params['GuestbookSerch']['keyword'];
            $query->orFilterWhere(['like', 'name', $key])
                    ->orFilterWhere(['like', 'email', $key])
                    ->orFilterWhere(['like', 'web_site', $key])
                    ->orFilterWhere(['like', 'subject', $key])
                    ->orFilterWhere(['like', 'content', $key])
                    ->orFilterWhere(['like', 'create_et', $key])
                    ->orFilterWhere(['like', 'update_et', $key]);
        }

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'web_site', $this->web_site])
                ->andFilterWhere(['like', 'subject', $this->subject])
                ->andFilterWhere(['like', 'content', $this->content])
                ->andFilterWhere(['like', 'create_et', $this->create_et])
                ->andFilterWhere(['like', 'update_et', $this->update_et]);

        return $dataProvider;
    }

}
