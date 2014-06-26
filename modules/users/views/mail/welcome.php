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

/**
 * @var dektrium\user\models\User $user
 */
?>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Yii::t('user', 'Hallo') ?>,
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Yii::t('user', 'Akun Anda pada {0} telah berhasil dibuat', Yii::$app->name) ?>.
    <?= Yii::t('user', 'Nama pengguna Anda adalah {0} dan Kata sandi anda adalah {1}', [$user->username, $user->password]) ?>.
</p>
<?php if (Yii::$app->getModule('user')->confirmable): ?>
    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
        <?= Yii::t('user', 'Dalam rangka untuk melengkapi pendaftaran anda, silahkan klik link di bawah') ?>:
    </p>
    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
        <?= Html::a(Html::encode($user->getConfirmationUrl()), $user->getConfirmationUrl()); ?>
    </p>
    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
        <?= Yii::t('user', 'Jika Anda memiliki masalah, silakan paste URL di atas ke browser web Anda') ?>.
        <?= Yii::t('user', 'URL ini hanya akan berlaku untuk waktu yang terbatas dan akan berakhir') ?>.
    </p>
<?php endif; ?>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Yii::t('user', 'Terima Kasih...') ?>.
</p>
