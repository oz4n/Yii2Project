<?php

use yii\helpers\Html;
$this->title = Yii::t('user', 'Pengaturan Data Anggota');
?>

<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
    <div class="container"> 
        <ul class="pull-right breadcrumb">
            <li><?= Html::a('Beranda', ['/site/site/index']) ?></li>              
            <li class="active"><?= Yii::$app->user->identity->username; ?></li>
        </ul>
    </div>
</div>
<div class="container content">

    <div class="row">
        <?php
        switch ($role) {
            case "ppimember":
                echo $this->render('_ppi_form', [
                    'member' => $member,
                    'user' => $user,
                ]);
                break;
            case "paskibramember":
                echo $this->render('_paskibra_form', [
                    'member' => $member,
                    'user' => $user,
                ]);
                break;
            case "capasmember":
                echo $this->render('_capas_form', [
                    'member' => $member,
                    'user' => $user,
                ]);
                break;
        }
        ?>        

    </div>
</div>