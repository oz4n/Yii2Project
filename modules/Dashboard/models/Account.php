<?php

namespace app\modules\Dashboard\models;

/**
 * This is the model class for table "account".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property string $email
 *
 * @property Post[] $posts
 * @property TermAccount[] $termAccounts
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'salt', 'email'], 'required'],
            [['username', 'password', 'salt', 'email'], 'string', 'max' => 128]
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

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveRelation
     */
    public function getTermAccounts()
    {
        return $this->hasMany(TermAccount::className(), ['account_id' => 'id']);
    }
}
