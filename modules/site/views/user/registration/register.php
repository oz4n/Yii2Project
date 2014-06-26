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
use yii\captcha\Captcha;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\User $user
 */
$this->title = Yii::t('user', 'Mendaftar');
?>
<div class="breadcrumbs">
    <div class="container">      
        <ul class="pull-right breadcrumb">
            <li><?= Html::a('Beranda', ['/site/site/index']) ?></li>
            <li class="active">Login</li>
        </ul>
    </div>   
</div>
<div class="container content">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            <?php
            $form = ActiveForm::begin([
                        'id' => 'registration-form',
            ]);
            ?>

            <?= $form->field($model, 'username')->label('Nama Akun') ?>

            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput()->label('Kata Sandi') ?>

            <?=
            $form->field($model, 'role')->dropDownList([
                'ppimember' => 'Anggota PPI',
                'paskibramember' => 'Anggota Paskibra',
                'capasmember' => 'Calon Anggota Paskibra',
            ])->label('Daftar Sebagai Anggota')
            ?>
            <?php
//            $form->field($model, 'verifyCode')->widget(Captcha::className(),[
//                'captchaAction' => '/site/site/captcha',
//                'imageOptions' => [                
//                    'backColor' => 0xFFFFFF, // background color  
//  
//                'foreColor' => 0x000000, // font color  
//  
//                'transparent' => false, // background transparent  
//  
//                'testLimit' => 4, // how many times should the same CAPTCHA be displayed  
//  
//                'minLength' => 6, // min length of generated word  
//  
//                'maxLength' => 7, // max length of generated word  
//                'width' => 100, // width of the CAPTCHA image  
//  
//                'height' => 100, // height of the CAPTCHA image  
//                'offset' => 2, // space between characters  
//  
//                'padding' => 4 // padding around the text  
//                ]                
//            ]) 
            ?>

            <?= Html::submitButton(Yii::t('user', 'Daftar'), ['class' => 'btn btn-u btn-block']) ?>

            <?php ActiveForm::end(); ?>
            <hr>
            <p class="text-center">
                <?= Html::a(Yii::t('user', 'Sudah terdaftar? Login!'), ['/user/security/login']) ?>
            </p>
        </div>
    </div>
</div>
