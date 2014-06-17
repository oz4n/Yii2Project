<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dektrium\user\widgets\Connect;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\LoginForm $model
 */

$this->title = Yii::t('user', 'Sign in');
?>
<div class="breadcrumbs">
    <div class="container">
        <h1 class="pull-left">Login</h1>
        <ul class="pull-right breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active">Login</li>
        </ul>
    </div>
    <!--/container-->
</div><!--/breadcrumbs-->
<div class="row">



    <div class="container content">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                <?php
                $form = \yii\bootstrap\ActiveForm::begin([
                    'id' => 'login-form',
                    'options' => ['class' => 'reg-page']
                ])
                ?>
                <div class="reg-header">
                    <h2>Login to your account</h2>
                </div>
                <?= $form->field($model, 'login') ?>

                <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('user', 'Password')) ?>



                <div class="row">
                    <div class="col-md-6">
                        <label class="checkbox">
                            <?= Html::activeCheckbox($model, 'rememberMe') ?>
                            Stay signed in
                        </label>
                    </div>
                    <div class="col-md-6">
                        <?= Html::submitButton(Yii::t('user', 'Sign in'), ['class' => 'btn-u pull-right']) ?>
                    </div>
                </div>
                <hr>
                <h4><?= Html::a(Yii::t('user', 'Forgot your password?'), ['/user/recovery/request']) ?></h4>

                <p><?= Html::a(Yii::t('user', 'Didn\'t receive confirmation message?'), ['/user/registration/resend']) ?></p>
                <?php \yii\bootstrap\ActiveForm::end(); ?>

                <?=
                Connect::widget([
                    'baseAuthUrl' => ['/user/security/auth']
                ])
                ?>

            </div>
        </div>
    </div>
</div>
