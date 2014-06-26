<?php
/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\User $model
 */
$this->title = Yii::t('user', 'Pengaturan Email');
?>
<div class="breadcrumbs">
    <div class="container"> 
        <ul class="pull-right breadcrumb">
            <li><?= Html::a('Beranda', ['/site/site/index']) ?></li>        
            <li ><?= Html::a(Yii::$app->user->identity->username, ['/site/member/index', 'role' => Yii::$app->user->identity->role, 'slug' => Yii::$app->user->identity->slug]) ?></li>
            <li class="active">Pengaturan Email</li>
        </ul>
    </div>
</div>
<div class="container content">
    <div class="row">       
        <div class="col-sm-12">
            <div class="sorting-block">

                <?=
                \yii\widgets\Menu::widget([
                    'options' => ['class' => 'sorting-nav sorting-nav-v1 text-center'],
                    'itemOptions' => ['class' => 'filter'],
                    'items' => [
                        ['label' => 'Data Anggota', 'url' => ['/site/member/index', 'role' => Yii::$app->user->identity->role, 'slug' => Yii::$app->user->identity->slug]],
//                        ['label' => Yii::t('user', 'Profil'), 'url' => ['/user/settings/profile']],
                        ['label' => Yii::t('user', 'Pengaturan Email'), 'url' => ['/user/settings/email']],
                        ['label' => Yii::t('user', 'Pengaturan Kata sandi'), 'url' => ['/user/settings/password']],
//                        ['label' => Yii::t('user', 'Networks'), 'url' => ['/user/settings/networks']],
                    ]
                ])
                ?>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?php if (Yii::$app->getSession()->hasFlash('settings_saved')): ?>

                        <div class="alert alert-success">
                            <?= Yii::$app->getSession()->getFlash('settings_saved') ?>
                        </div>

                    <?php endif; ?>
                     <?php
                    $form = \yii\widgets\ActiveForm::begin([
                                'id' => 'profile-form',
                                'options' => ['class' => 'form-horizontal'],
                                'fieldConfig' => [
                                    'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-6\">{error}\n{hint}</div>",
                                    'labelOptions' => ['class' => 'col-lg-3 control-label'],
                                ],
                    ]);
                    ?>

                    <?php if (!empty($model->unconfirmed_email)): ?>
                        <div class="alert alert-warning">
                            <?= Yii::t('user', 'Sebelum email Anda akan berubah? sistem membutuhkan Anda untuk mengkonfirmasi alamat email baru silahkan konfirmasi terlebih dahulu.') ?>
                            <br>
                            <?= \yii\helpers\Html::a(Yii::t('user', 'Batalkan perubahan email'), Url::to(['reset']), ['class' => 'btn btn-danger btn-xs', "data-confirm" => "Apakah Anda yakin akan menghapus item ini?", 'data-method' => 'post']) ?>
                        </div>
                        <?php
                    endif;
                    ?>                   

                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= Yii::t('user', 'Email Sebelumnya') ?></label>
                        <div class="col-lg-6">
                            <p class="form-control-static"><?= $model->email ?></p>
                        </div>
                    </div>

                    <?=
                    $form->field($model, 'unconfirmed_email')->label('Email Baru')
                    ?>

                    <?=
                    $form->field($model, 'current_password')->passwordInput()->label('Kata Sandi')
                    ?>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"></label>
                        <div class="col-lg-9">
                            <?= Html::submitButton('<i class="fa fa-check"></i>&nbsp; Simpan', ['class' => 'btn btn-u']) ?>
                        </div>
                    </div>
                    <?php
                    ActiveForm::end();
                    ?>


                </div>
            </div>
        </div>
    </div>
</div>
