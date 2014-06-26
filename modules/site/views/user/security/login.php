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
$this->title = Yii::t('user', 'Login');
?>
<div class="breadcrumbs">
    <div class="container">      
        <ul class="pull-right breadcrumb">
            <li><?= Html::a('Beranda', ['/site/site/index']) ?></li>
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
                            'id' => 'login-form'
                        ])
                        
                ?>
                <div class="reg-header">
                    <h2>Login ke akun anda</h2>
                </div>
                <?=
                $form->field($model, 'login')->label('Akun anda')
                ?>

                <?=
                $form->field($model, 'password')->passwordInput()->label(Yii::t('user', 'Password'))->label('Kata sandi')
                ?>



                <div class="row">
                    <div class="col-md-6">
                        <label class="checkbox">
                            <?=
                            Html::activeCheckbox($model, 'rememberMe')
                            ?>
                            Tetap masuk
                        </label>
                    </div>
                    <div class="col-md-6">
                        <?=
                        Html::submitButton(Yii::t('user', 'Login'), ['class' => 'btn-u pull-right'])
                        ?>
                    </div>
                </div>
                <hr>
                <h4><?= Html::a(Yii::t('user', 'Lupa kata sandi anda?'), ['/user/recovery/request']) ?></h4>

                <p><?= Html::a(Yii::t('user', 'Tidak menerima pesan konfirmasi?'), ['/user/registration/resend']) ?></p>
                <?php
                \yii\bootstrap\ActiveForm::end();
                ?>

                <?=
                Connect::widget([
                    'baseAuthUrl' => ['/user/security/auth']
                ])
                ?>

            </div>
        </div>
    </div>
</div>
