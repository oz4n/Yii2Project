<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\site\models;

use Yii;
use app\modules\dao\ar\Guestbook;
use app\modules\site\Site;

/**
 * Description of GuestbookModel
 *
 * @author melengo
 */
class GuestbookModel extends Guestbook
{

    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'parent_id'], 'integer'],
            [['name', 'email', 'subject', 'content', 'create_et', 'update_et'], 'required', 'message' => 'Tidak boleh kosong.'],
            [['create_et', 'update_et'], 'safe'],
            [['content'], 'string'],
            [['name', 'email', 'web_site', 'status'], 'string', 'max' => 45, 'message' => 'Maksimum 45 huruf'],
            [['subject'], 'string', 'max' => 128, 'message' => 'Maksimum 128 huruf']
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
            'verifyCode' => 'Verification Code',
        ];
    }

    public function getAllMassageByParent($paren)
    {
        $model = self::find();
        return $model->onCondition([
                    'status' => Site::GUESTBOOK_PUBLISH_STATUS,
                    'parent_id' => $paren
                ])->all();
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->setAttribute('subject', strip_tags($this->subject));
            $this->setAttribute('name', strip_tags($this->name));
            $this->setAttribute('email', strip_tags($this->email));
            $this->setAttribute('content', strip_tags($this->content, '<p><a><ul><ol><li>'));
        }
        return parent::beforeSave($insert);
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mail->compose()
                    ->setTo($email)
                    ->setFrom([$this->email => $this->name])
                    ->setSubject($this->subject)
                    ->setTextBody($this->body)
                    ->send();

            return true;
        } else {
            return false;
        }
    }

}
