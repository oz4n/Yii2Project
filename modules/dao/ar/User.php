<?php

namespace app\modules\dao\ar;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $user_name
 * @property string $first_name
 * @property string $last_name
 * @property string $middel_name
 * @property string $display_name
 * @property string $full_name
 * @property string $password
 * @property string $password_salt
 * @property string $email
 * @property integer $state
 * @property string $picture
 * @property string $registration_token
 * @property string $question
 * @property string $answer
 * @property integer $email_confirmed
 * @property string $last_login
 * @property string $created
 * @property string $updated
 *
 * @property Comment[] $comments
 * @property File[] $files
 * @property GuestBook[] $guestBooks
 * @property Member[] $members
 * @property Post[] $posts
 * @property Taxuser[] $taxusers
 * @property UserLog[] $userLogs
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_name', 'first_name', 'last_name', 'display_name', 'password', 'email', 'registration_token', 'question', 'answer', 'last_login', 'created', 'updated'], 'required'],
            [['state', 'email_confirmed'], 'integer'],
            [['picture'], 'string'],
            [['last_login', 'created', 'updated'], 'safe'],
            [['user_name', 'first_name', 'last_name', 'middel_name', 'display_name', 'full_name'], 'string', 'max' => 45],
            [['password', 'password_salt', 'registration_token'], 'string', 'max' => 128],
            [['email', 'question', 'answer'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_name' => Yii::t('app', 'User Name'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'middel_name' => Yii::t('app', 'Middel Name'),
            'display_name' => Yii::t('app', 'Display Name'),
            'full_name' => Yii::t('app', 'Full Name'),
            'password' => Yii::t('app', 'Password'),
            'password_salt' => Yii::t('app', 'Password Salt'),
            'email' => Yii::t('app', 'Email'),
            'state' => Yii::t('app', 'State'),
            'picture' => Yii::t('app', 'Picture'),
            'registration_token' => Yii::t('app', 'Registration Token'),
            'question' => Yii::t('app', 'Question'),
            'answer' => Yii::t('app', 'Answer'),
            'email_confirmed' => Yii::t('app', 'Email Confirmed'),
            'last_login' => Yii::t('app', 'Last Login'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
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
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxusers()
    {
        return $this->hasMany(Taxuser::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLogs()
    {
        return $this->hasMany(UserLog::className(), ['user_id' => 'id']);
    }
}
