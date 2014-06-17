<?php

use yii\helpers\Url;
use yii\widgets\ListView;
use yii\helpers\Html;

$this->title = "Buku Tamu";
$this->registerMetaTag(['name' => 'keywords', 'content' =>'buku tamu']);

?>
<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
    <div class="container">
        <h1 class="pull-left">Buku Tamu</h1>
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
            <?php
            $form = \yii\widgets\ActiveForm::begin();
            echo ListView::widget([

                'dataProvider' => $dataProvider,
                'layout' =>
                Html::beginTag('div', ['class' => 'timeline-v2'])
                . '{items}'
                . Html::beginTag('div', ['class' => 'timeline-list'])
                . Html::img(\Yii::getAlias('@web') . '/resources/images/default/user50x50.png', ['class' => 'rounded-x hidden-xs'])
                . Html::beginTag('div', ['class' => 'cbp_tmlabel', 'style' => 'color:#555'])
                . Html::tag('H2', 'Pesan')
                . Html::tag('div', '<strong>Info!</strong> Silahkan para pengunjung sekalian memberikan penilaian, kritik dan saran yang membangun pada form berikut ini.', ['class' => 'tag-box tag-box-v4'])
                . $form->field($model, 'name')->textInput()->label('Nama')
                . $form->field($model, 'email')->textInput()
                . $form->field($model, 'subject')->textInput()->label('Subjek')
                . $form->field($model, 'content')->textarea(['rows' => 7, 'style' => 'resize:none'])->label('Pesan')
                . Html::beginTag('div', ['class' => 'form-group'])
                . Html::button('<i class="fa fa-check"></i>&nbsp; Kirim pesan', ['class' => 'btn-u'])
                . Html::endTag('div')
                . Html::endTag('div')
                . Html::endTag('div')
                . Html::endTag('div')
                . Html::beginTag('div', ['class' => 'text-center'])
                . '{pager}'
                . Html::endTag('div'),
                'options' => [
                    'class' => ''
                ],
                'pager' => [
                    'nextPageLabel' => 'Next',
                    'prevPageLabel' => 'Prev',
                ],
                'itemOptions' => ['class' => 'timeline-list'],
                'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_view', [
                        'model' => $model,
                        'index' => $index,
            ]);
        },
            ]);
            \yii\widgets\ActiveForm::end();
            ?>
        </div>
    </div>
</div>
