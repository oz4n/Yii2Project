<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/9/14
 * Time: 1:45 AM
 */

namespace app\modules\dashboard\controllers;
use yii\web\Controller;

class ErrorController extends Controller
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
} 