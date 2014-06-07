<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\dashboard\helpers;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use cebe\gravatar\Gravatar;
use app\modules\dashboard\models\GuestbookModel;

/**
 * Description of Message
 *
 * @author melengo
 */
class Message extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $this->renderItem();
        parent::run();
    }

    public function renderItem()
    {
        $label1 = Html::tag('span', $this->getNewMessageLeng(), ['class' => 'label', 'id' => 'message-length']);
        $icon = Html::tag('i', '', ['class' => 'nav-icon fa fa-comments-o']);
        $label2 = Html::tag('span', 'Income messages', ['class' => 'small-screen-text']);
        echo Html::a($label1 . $icon . $label2, '#messages', ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown']);
        echo Html::beginTag('div', ['class' => 'dropdown-menu widget-messages-alt no-padding', 'style' => 'width: 300px']);
        echo Html::beginTag('div', ['page-data' => 1, 'class' => 'messages-list', 'id' => 'main-navbar-messages']);
        foreach ($this->getMessage() as $v) {
            echo $this->htmlTagBuilder($v->email, Url::toRoute(['/guestbook/guestbook/replay', 'action' => 'guestbook-replay', 'id' => $v->id]), $v->create_et, $v->name, $v->subject, $v->status, $v->id);
        }
        echo Html::endTag('div');
        echo Html::beginTag('div', ['class' => 'text-center', 'id' => 'img-messages-loading', 'style' => 'display:none']);
        echo Html::img(Yii::getAlias('@web') . '/PixelAdmin/img/loading.gif');
        echo Html::endTag('div');
        echo Html::a('SELENGKAPNYA', Url::toRoute(['/guestbook/guestbook/index', 'action' => 'guestbook-list']), ['class' => 'messages-link']);
        echo Html::endTag('div');
    }

    public function getNewMessageLeng()
    {
        $model = new GuestbookModel;
        return $model->getNewMessageLeng();

    }

    public function getMessage()
    {
        $model = new GuestbookModel;
        return $model->getMessage(0, 9)->all();
    }

    protected function htmlTagBuilder($email, $url, $date, $username, $subject, $status, $data_id)
    {
        $img = Gravatar::widget([
            'email' => $email,
            'size' => 32,
            'defaultImage' => 'mm',
            'options' => [
                'class' => 'message-avatar'
            ]
        ]);
        $a = Html::tag('span', $subject, ['class' => 'message-subject']);
        $description = Html::tag('div', '<span style="border-radius: 2px; padding-right:5px; padding-bottom:2px; padding-left:5px; background: #5bc0de; color:#fff">baru</span>&nbsp;' . 'dari &nbsp;' . $username . '&nbsp;·&nbsp;' . $date, ['class' => 'message-description']);
        $message = Html::tag('div', $img . $a . $description, ['class' => 'message']);
        if ($status === "Unconfirmed") {
            return Html::a(Html::tag('div', $message, ['style' => 'border-bottom: 1px solid; border-bottom-color:#ccc; background:#F3F2F2', 'class' => 'messages-list', 'id' => 'main-navbar-messages']), $url, ['message-id' => 'message-' . $data_id]);
        } else {
            return Html::a(Html::tag('div', $message, ['style' => 'border-bottom: 1px solid; border-bottom-color:#ccc ', 'class' => 'messages-list', 'id' => 'main-navbar-messages']), $url, ['message-id' => 'message-' . $data_id]);
        }
    }

}
