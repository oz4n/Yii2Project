<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/8/14
 * Time: 3:44 PM
 */

namespace app\modules\users\searchs;

use app\modules\users\models\UserModel;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class UserSearch extends UserModel
{

    public $keyword;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'confirmation_sent_at', 'confirmed_at', 'recovery_sent_at', 'blocked_at', 'registered_from', 'logged_in_from', 'logged_in_at', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email', 'password_hash', 'auth_key', 'confirmation_token', 'unconfirmed_email', 'recovery_token', 'role', 'slug'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => \Yii::t('user', 'Username'),
            'email' => \Yii::t('user', 'Email'),
            'created_at' => \Yii::t('user', 'Registration time'),
            'registered_from' => \Yii::t('user', 'Registration ip'),
        ];
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = self::find();
        $query->andFilterWhere(['not like', 'role', 'paskibramember']);
        $query->andFilterWhere(['not like', 'role', 'ppimember']);
        $query->andFilterWhere(['not like', 'role', 'capasmember']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        if (isset($params['UserSearch']['keyword'])) {
            $key = $params['UserSearch']['keyword'];
            $query->orFilterWhere(['like', 'username', $key]);
            $query->orFilterWhere(['like', 'email', $key]);
            $query->orFilterWhere(['like', 'role', $key]);
        }

        $this->addCondition($query, 'username', true);
        $this->addCondition($query, 'email', true);
        $this->addCondition($query, 'created_at');
        $this->addCondition($query, 'registered_from');

        return $dataProvider;
    }

    /**
     * @param $query
     * @param $attribute
     * @param bool $partialMatch
     */
    protected function addCondition($query, $attribute, $partialMatch = false)
    {
        $value = $this->$attribute;
        if (trim($value) === '') {
            return;
        }
        if ($attribute == 'registered_from') {
            $value = ip2long($value);
        }
        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }

}
