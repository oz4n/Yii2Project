<?php

namespace app\modules\dashboard\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Json;
use app\modules\dashboard\models\GuestbookModel;
use cebe\gravatar\Gravatar;
use yii\helpers\Url;
use yii\web\HttpException;

class DashboardController extends Controller
{

    public function actions()
    {
        $this->layout = 'error';
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'               
            ]
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->can('dashboardindex')) {
            return $this->render('index');
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionLoadmessage()
    {
        if (Yii::$app->user->can('dashboardloadmessage')) {
            if (Yii::$app->request->isAjax) {
                $model = new GuestbookModel;
                $param = Yii::$app->request->getQueryParams();
                $per_page = 9;
                $from = ($param['page_id'] * $per_page);
                $query = $model->getMessage($from, $per_page)->all();
                $data = [];
                foreach ($query as $value) {
                    $data[] = [
                        'url' => Url::toRoute(['/guestbook/guestbook/replay/', 'action' => 'guestbook-replay', 'id' => $value->id]),
                        'name' => $value->name,
                        'dataid' => $value->id,
                        'date' => $value->create_et,
                        'status' => $value->status,
                        'subject' => $value->subject,
                        'pagedata' => ($param['page_id'] + 1),
                        'img' => Gravatar::widget([
                            'email' => $value->email,
                            'size' => 32,
                            'defaultImage' => 'mm',
                            'options' => [
                                'class' => 'message-avatar'
                            ]
                        ])
                    ];
                }
                echo Json::encode($data);
            } else {
                
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionLoadmessagelength()
    {
        if (Yii::$app->user->can('dashboardloadmessagelenght')) {
            if (Yii::$app->request->isAjax) {
                $model = new GuestbookModel;
                echo Json::encode([
                    'leng' => $model->getNewMessageLeng()
                ]);
            } else {
                
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

}
