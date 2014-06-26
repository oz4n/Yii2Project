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

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\forms\Resend $model
 */
$this->title = Yii::t('user', 'Meminta pesan konfirmasi baru');
?>
<div class="breadcrumbs">
    <div class="container">      
        <ul class="pull-right breadcrumb">
            <li><?= Html::a('Beranda', ['/site/site/index']) ?></li>
            <li class="active">Konfirmasi Akun</li>
        </ul>
    </div>
    <!--/container-->
</div><!--/breadcrumbs-->
<div class="container content">

    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            <?php
            $form = ActiveForm::begin([
                        'id' => 'resend-form',
            ]);
            ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label('Email Anda') ?>

            <?= Html::submitButton(Yii::t('user', 'Kirim konfirmasi'), ['class' => 'btn btn-u btn-block']) ?><br>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
