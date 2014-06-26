<?php

namespace app\modules\dao\ar;

use Yii;

/**
 * This is the model class for table "guest_book".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $parent_id
 * @property string $name
 * @property string $email
 * @property string $web_site
 * @property string $subject
 * @property string $content
 * @property string $status
 * @property string $create_et
 * @property string $update_et
 *
 * @property Guestbook $parent
 * @property Guestbook[] $guestbooks
 * @property User $user
 */
class Guestbook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guest_book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'parent_id'], 'integer'],
            [['name', 'email', 'subject', 'content', 'create_et', 'update_et'], 'required', 'message' => 'Tidak boleh kosong.'],
            [['content'], 'string'],
            [['create_et', 'update_et'], 'safe'],
            [['name', 'email', 'web_site', 'status'], 'string', 'max' => 45],
            [['subject'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'web_site' => Yii::t('app', 'Web Site'),
            'subject' => Yii::t('app', 'Subject'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
            'create_et' => Yii::t('app', 'Create Et'),
            'update_et' => Yii::t('app', 'Update Et'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Guestbook::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuestbooks()
    {
        return $this->hasMany(Guestbook::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
