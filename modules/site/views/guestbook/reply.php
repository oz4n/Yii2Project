<?php

use yii\helpers\Url;
use yii\widgets\ListView;
use yii\helpers\Html;

$this->title = "Buku Tamu";
$this->registerMetaTag(['name' => 'keywords', 'content' => 'buku tamu']);
?>
<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
    <div class="container">      
        <ul class="pull-right breadcrumb">
            <li><a href="<?= Url::toRoute(['/site/site/index']) ?>">Beranda</a></li>              
            <li class="active">Buku Tamu</li>
        </ul>
    </div>
</div>
<!--/breadcrumbs-->
<!--=== End Breadcrumbs ===-->
<div class="container content">
    <div class="row">        
        <div class="col-md-12">
            <?php if (\Yii::$app->session->getFlash('success') !== null): ?>
                <div class="alert alert-success fade in">
                    <strong>Terimakasih!</strong> <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif; ?>
            <?php $form = \yii\widgets\ActiveForm::begin(); ?>            
            <div class="timeline-v2">
                <div class="timeline-list">

                    <time class="cbp_tmtime" datetime="">
                        <span><?= date('m/d/Y', strtotime($data->create_et)) ?></span> <span><?= date('F', strtotime($data->create_et)) ?></span>
                    </time>

                    <?=
                    \cebe\gravatar\Gravatar::widget([
                        'email' => $data->email,
                        'size' => 45,
                        'defaultImage' => 'mm',
                        'options' => [
                            'alt' => $data->name,
                            'class' => 'rounded-x hidden-xs'
                        ]
                    ])
                    ?>
                    <div class="cbp_tmlabel">

                        <h2><?= $data->subject ?></h2>

                        <p><?= $data->content ?></p>
                        <blockquote>
                            <small>@<?= $data->name ?></small>
                        </blockquote>   
                        <?php foreach ($data->getAllMassageByParent($data->id) as $value): ?>
                            <div class="media">
                                <div class="pull-left">
                                    <?=
                                    \cebe\gravatar\Gravatar::widget([
                                        'email' => $value->email,
                                        'size' => 32,
                                        'defaultImage' => 'mm',
                                        'options' => [
                                            'alt' => $value->name,
                                            'class' => 'rounded-x hidden-xs'
                                        ]
                                    ])
                                    ?>
                                </div>
                                <div class="media-body">                
                                    <p>@<?= $value->name ?>&nbsp;|&nbsp;<?= $value->content; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>


                </div>
                <?php
                echo Html::beginTag('div', ['class' => 'timeline-list'])
                .\cebe\gravatar\Gravatar::widget([
                        'email' => $data->email,
                        'size' => 45,
                        'defaultImage' => 'mm',
                        'options' => [
                            'alt' => $data->name,
                            'class' => 'rounded-x hidden-xs'
                        ]
                    ])
                . Html::beginTag('div', ['class' => 'cbp_tmlabel', 'style' => 'color:#555'])
                . Html::tag('H2', 'Pesan')
                . Html::tag('div', '<strong>Info!</strong> Silahkan para pengunjung sekalian memberikan penilaian, kritik dan saran yang membangun pada form berikut ini.', ['class' => 'tag-box tag-box-v4'])
                . Html::activeHiddenInput($model, 'parent_id', ['value' => $data->id])
                . $form->field($data, 'name')->textInput()->label('Nama')
                . $form->field($data, 'email')->textInput()
                . $form->field($data, 'subject')->textInput()->label('Subjek')
                . $form->field($model, 'content')->textarea(['rows' => 7, 'style' => 'resize:none'])->label('Pesan')
                . Html::beginTag('div', ['class' => 'form-group'])
                . Html::button('<i class="fa fa-check"></i>&nbsp; Kirim pesan', ['class' => 'btn-u'])
                . Html::endTag('div')
                . Html::endTag('div')
                . Html::endTag('div');
                ?>
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
</div>
