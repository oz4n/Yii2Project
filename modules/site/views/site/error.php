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
?>
<div class="breadcrumbs">
    <div class="container">
        <h1 class="pull-left"><?= Html::encode($this->title) ?></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?= Url::toRoute(['/site/site/index']) ?>">Beranda</a></li>           
            <li class="active"><?= Html::encode($this->title) ?></li>
        </ul>
    </div> 
</div>


<div class="container content">		
    <!--Error Block-->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="error-v1">
                <span><?= Html::encode($this->title) ?></span>
                <p><?= nl2br(Html::encode($message)) ?></p>
                <a href="<?= Url::toRoute(['/site/site/index']) ?>">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
    <!--End Error Block-->
</div>