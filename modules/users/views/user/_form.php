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
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'username')->textInput(['maxlength' => 25, 'autofocus' => true])->label("Login Akun") ?>

<?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<?= $form->field($model, 'role')->dropDownList($model->getRules(), ['maxlength' => 255])->label("Hak AKses") ?>

<div class="form-group">
    <?= Html::submitButton('<i class="fa fa-check"></i>&nbsp; ' . Yii::t('user', 'Simpan'), ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>