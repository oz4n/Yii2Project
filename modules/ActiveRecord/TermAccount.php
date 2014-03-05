<?php

namespace app\modules\ActiveRecord;

/**
 * This is the model class for table "term_account".
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 * @property string $autoload
 * @property integer $account_id
 *
 * @property Account $account
 */
class TermAccount extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'term_account';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['key', 'value', 'account_id'], 'required'],
			[['account_id'], 'integer'],
			[['key', 'value'], 'string', 'max' => 255],
			[['autoload'], 'string', 'max' => 5]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'key' => 'Key',
			'value' => 'Value',
			'autoload' => 'Autoload',
			'account_id' => 'Account ID',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAccount()
	{
		return $this->hasOne(Account::className(), ['id' => 'account_id']);
	}
}
