<?php

namespace app\modules\userlog\searchs;

use app\modules\userlog\models\UserLogModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserLogSerch represents the model behind the search form about `app\modules\dao\ar\UserLog`.
 */
class UserLogSerch extends UserLogModel
{
    public $keyword;

    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['user_ip', 'title', 'content', 'absolute_url', 'browser', 'browser_version', 'user_agent', 'action_method', 'platform','country_code',  'contry', 'region', 'city', 'zip_code', 'latitude', 'longitude', 'time_zone', 'create_at', 'update_et'], 'safe'],
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

        if (isset($params['UserLogSerch']['keyword'])) {
            $this->keyword = $params['UserLogSerch']['keyword'];
            $query->orFilterWhere(['like', 'user_ip', $this->keyword])
                ->orFilterWhere(['like', 'title', $this->keyword])
                ->orFilterWhere(['like', 'content', $this->keyword])
                ->orFilterWhere(['like', 'absolute_url', $this->keyword])
                ->orFilterWhere(['like', 'user_agent', $this->keyword])
                ->orFilterWhere(['like', 'action_method', $this->keyword])
                ->orFilterWhere(['like', 'platform', $this->keyword])
                ->orFilterWhere(['like', 'contry', $this->keyword])
                ->orFilterWhere(['like', 'country_code', $this->keyword])
                ->orFilterWhere(['like', 'region', $this->keyword])
                ->orFilterWhere(['like', 'city', $this->keyword])
                ->orFilterWhere(['like', 'zip_code', $this->keyword])
                ->orFilterWhere(['like', 'browser', $this->keyword])
                ->orFilterWhere(['like', 'browser_version', $this->keyword])
                ->orFilterWhere(['like', 'latitude', $this->keyword])
                ->orFilterWhere(['like', 'longitude', $this->keyword])
                ->orFilterWhere(['like', 'time_zone', $this->keyword]);
        }
        $query->andFilterWhere(['like', 'user_ip', $this->user_ip])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'absolute_url', $this->absolute_url])
            ->andFilterWhere(['like', 'user_agent', $this->user_agent])
            ->andFilterWhere(['like', 'action_method', $this->action_method])
            ->andFilterWhere(['like', 'platform', $this->platform])
            ->andFilterWhere(['like', 'contry', $this->contry])
            ->andFilterWhere(['like', 'country_code', $this->country_code])
            ->andFilterWhere(['like', 'region', $this->region])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'zip_code', $this->zip_code])
            ->andFilterWhere(['like', 'browser', $this->browser])
            ->andFilterWhere(['like', 'browser_version', $this->browser_version])
            ->andFilterWhere(['like', 'latitude', $this->latitude])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'time_zone', $this->time_zone]);

        return $dataProvider;
    }
}
