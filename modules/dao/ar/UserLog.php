<?php

namespace app\modules\dao\ar;

use Yii;

/**
 * This is the model class for table "user_log".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $user_ip
 * @property string $title
 * @property string $content
 * @property string $absolute_url
 * @property string $user_agent
 * @property string $action_method
 * @property string $platform
 * @property string $contry
 * @property string $country_code
 * @property string $region
 * @property string $city
 * @property string $zip_code
 * @property string $browser
 * @property string $browser_version
 * @property string $latitude
 * @property string $longitude
 * @property string $time_zone
 * @property string $create_at
 * @property string $update_et
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
            [['user_id'], 'integer'],
            [['user_ip', 'title', 'absolute_url', 'user_agent', 'action_method', 'platform', 'contry', 'region', 'city', 'browser', 'browser_version', 'latitude', 'longitude', 'time_zone', 'create_at', 'update_et'], 'required'],
            [['content', 'absolute_url', 'user_agent'], 'string'],
            [['create_at', 'update_et'], 'safe'],
            [['user_ip', 'title', 'platform', 'contry', 'region', 'city', 'browser', 'time_zone'], 'string', 'max' => 255],
            [['action_method', 'zip_code', 'browser_version', 'latitude', 'longitude'], 'string', 'max' => 45],
            [['country_code'], 'string', 'max' => 5]
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
            'user_ip' => Yii::t('app', 'User Ip'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'absolute_url' => Yii::t('app', 'Absolute Url'),
            'user_agent' => Yii::t('app', 'User Agent'),
            'action_method' => Yii::t('app', 'Action Method'),
            'platform' => Yii::t('app', 'Platform'),
            'contry' => Yii::t('app', 'Contry'),
            'country_code' => Yii::t('app', 'Country Code'),
            'region' => Yii::t('app', 'Region'),
            'city' => Yii::t('app', 'City'),
            'zip_code' => Yii::t('app', 'Zip Code'),
            'browser' => Yii::t('app', 'Browser'),
            'browser_version' => Yii::t('app', 'Browser Version'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'time_zone' => Yii::t('app', 'Time Zone'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_et' => Yii::t('app', 'Update Et'),
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
