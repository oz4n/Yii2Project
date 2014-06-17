<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var string $name
 * @var string $message
 * @var Exception $exception
 */
$this->title = $name;
$str = explode(" ", $this->title)
?>
<div class="error-code"><?= $str[count($str) - 1] ?></div>

<div class="error-text">
    <span class="oops"><?= Html::encode(str_replace($str[count($str) - 1], "", $this->title)) ?></span><br>
    <span class="hr"></span>
    <br>
    <?= nl2br(Html::encode($message)) ?>
    <br>
    <span ><a style="color: rgba(0,0,0,.5);" href="<?= Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard-list']) ?>">Kembali ke Beranda</a></span>
</div>
