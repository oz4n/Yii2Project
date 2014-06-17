<?php

namespace app\modules\dao\ar;

use Yii;
use dektrium\user\models\User as BaseUser;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property string $confirmation_token
 * @property integer $confirmation_sent_at
 * @property integer $confirmed_at
 * @property string $unconfirmed_email
 * @property string $recovery_token
 * @property integer $recovery_sent_at
 * @property integer $blocked_at
 * @property string $role
 * @property integer $registered_from
 * @property integer $logged_in_from
 * @property integer $logged_in_at
 * @property string $slug
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthAssignment $authAssignment
 * @property AuthItem[] $itemNames
 * @property Comment[] $comments
 * @property File[] $files
 * @property GuestBook[] $guestBooks
 * @property Member[] $members
 * @property Message $message
 * @property Post[] $posts
 * @property Profile $profile
 * @property UserLog[] $userLogs
 */
class User extends BaseUser
{

    public $captcha;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['register'][] = 'captcha';
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'auth_key', 'created_at', 'updated_at'], 'required', 'message' => 'Tidak boleh kosong'],
            [['confirmation_sent_at', 'confirmed_at', 'recovery_sent_at', 'blocked_at', 'registered_from', 'logged_in_from', 'logged_in_at', 'created_at', 'updated_at'], 'integer'],
            [['slug'], 'string'],
            [['username'], 'string', 'max' => 25],
            [['email', 'unconfirmed_email', 'role'], 'string', 'max' => 255],
            [['password_hash'], 'string', 'max' => 60],
            [['auth_key', 'confirmation_token', 'recovery_token'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'confirmation_token' => Yii::t('app', 'Confirmation Token'),
            'confirmation_sent_at' => Yii::t('app', 'Confirmation Sent At'),
            'confirmed_at' => Yii::t('app', 'Confirmed At'),
            'unconfirmed_email' => Yii::t('app', 'Unconfirmed Email'),
            'recovery_token' => Yii::t('app', 'Recovery Token'),
            'recovery_sent_at' => Yii::t('app', 'Recovery Sent At'),
            'blocked_at' => Yii::t('app', 'Blocked At'),
            'role' => Yii::t('app', 'Role'),
            'registered_from' => Yii::t('app', 'Registered From'),
            'logged_in_from' => Yii::t('app', 'Logged In From'),
            'logged_in_at' => Yii::t('app', 'Logged In At'),
            'slug' => Yii::t('app', 'Slug'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignment()
    {
        return $this->hasOne(AuthAssignment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemNames()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'item_name'])->viaTable('auth_assignment', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuestBooks()
    {
        return $this->hasMany(GuestBook::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessage()
    {
        return $this->hasOne(Message::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLogs()
    {
        return $this->hasMany(UserLog::className(), ['user_id' => 'id']);
    }

}
