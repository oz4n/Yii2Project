<?php

namespace app\modules\Dashboard\DAO;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\Dashboard\models\Account;

/**
 * AccountSerch represents the model behind the search form about Account.
 */
class AccountSerch extends Model
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
		$query = Account::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'username');
		$this->addCondition($query, 'username', true);
		$this->addCondition($query, 'password');
		$this->addCondition($query, 'password', true);
		$this->addCondition($query, 'salt');
		$this->addCondition($query, 'salt', true);
		$this->addCondition($query, 'email');
		$this->addCondition($query, 'email', true);
		return $dataProvider;
	}

	protected function addCondition($query, $attribute, $partialMatch = false)
	{
		$value = $this->$attribute;
		if (trim($value) === '') {
			return;
		}
		if ($partialMatch) {
			$value = '%' . strtr($value, ['%'=>'\%', '_'=>'\_', '\\'=>'\\\\']) . '%';
			$query->andWhere(['like', $attribute, $value]);
		} else {
			$query->andWhere([$attribute => $value]);
		}
	}
}
