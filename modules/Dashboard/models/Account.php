<?php

namespace app\modules\Dashboard\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\ActiveRecord\Account as AccountModel;

/**
 * Account represents the model behind the search form about `app\modules\ActiveRecord\Account`.
 */
class Account extends Model
{
	public $id;
	public $username;
	public $password;
	public $salt;
	public $email;

	public function rules()
	{
		return [
			[['id'], 'integer'],
			[['username', 'password', 'salt', 'email'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'salt' => 'Salt',
			'email' => 'Email',
		];
	}

	public function search($params)
	{
		$query = AccountModel::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'username', true);
		$this->addCondition($query, 'password', true);
		$this->addCondition($query, 'salt', true);
		$this->addCondition($query, 'email', true);
		return $dataProvider;
	}

	protected function addCondition($query, $attribute, $partialMatch = false)
	{
		if (($pos = strrpos($attribute, '.')) !== false) {
			$modelAttribute = substr($attribute, $pos + 1);
		} else {
			$modelAttribute = $attribute;
		}

		$value = $this->$modelAttribute;
		if (trim($value) === '') {
			return;
		}
		if ($partialMatch) {
			$query->andWhere(['like', $attribute, $value]);
		} else {
			$query->andWhere([$attribute => $value]);
		}
	}
}
