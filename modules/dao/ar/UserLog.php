<?php

namespace app\modules\dao\ar;

use Yii;

/**
 * This is the model class for table "user_log".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $create_at
 * @property string $url
 * @property string $content
 * @property string $contry
 * @property string $ip_address
 * @property string $sistem_oprasi
 * @property string $city
 * @property string $browser
 *
 * @property Taxuserlogrelations $taxuserlogrelations
 * @property Taxonomy[] $taxonomies
 * @property User $user
 */
class UserLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'create_at', 'url', 'content', 'contry', 'ip_address', 'sistem_oprasi', 'city', 'browser'], 'required'],
            [['user_id'], 'integer'],
            [['create_at'], 'safe'],
            [['url', 'content'], 'string'],
            [['contry', 'sistem_oprasi', 'city', 'browser'], 'string', 'max' => 45],
            [['ip_address'], 'string', 'max' => 128]
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
            'create_at' => Yii::t('app', 'Create At'),
            'url' => Yii::t('app', 'Url'),
            'content' => Yii::t('app', 'Content'),
            'contry' => Yii::t('app', 'Contry'),
            'ip_address' => Yii::t('app', 'Ip Address'),
            'sistem_oprasi' => Yii::t('app', 'Sistem Oprasi'),
            'city' => Yii::t('app', 'City'),
            'browser' => Yii::t('app', 'Browser'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxuserlogrelations()
    {
        return $this->hasOne(Taxuserlogrelations::className(), ['user_log_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxonomies()
    {
        return $this->hasMany(Taxonomy::className(), ['id' => 'taxonomy_id'])->viaTable('taxuserlogrelations', ['user_log_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
