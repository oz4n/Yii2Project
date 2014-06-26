<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Guestbook $model
 * @var yii\widgets\ActiveForm $form
 */
$this->registerJs(
        "$('ul.navigation > li#guestbook').addClass('active');"
        , View::POS_READY);
?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?= Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?= Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard-list']); ?>"><?= Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?= Url::toRoute(['/guestbook/guestbook/index', 'action' => 'guestbook-list']); ?>"><?= Yii::t('app', Html::encode('Buku Tamu')); ?></a>
    </li>
    <li class="active">
        Balas
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa  fa-comments-o page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Buku Tamu') ?>                
            </h1>
        </div>        
    </div>
</div>
<div class="row">
    <div class="col-sm-8">
        <div class="timeline">
            <!-- Timeline header -->
            <div class="tl-header now"><?= $model->name ?></div>

            <div class="tl-entry">               
                <div class="tl-icon">
                    <?=
                    \cebe\gravatar\Gravatar::widget([
                        'email' => $model->email,
                        'size' => 40,
                        'defaultImage' => 'mm'
                    ]);
                    ?>
                </div>
                <div class="panel tl-body">
                    <h4 class="text-info"><?= $model->subject ?></h4>
                    <p>
                        <i class="fa fa-user"></i> &nbsp;<?= $model->name ?>&nbsp;&nbsp;&nbsp; <i class="fa fa-calendar"></i>&nbsp; <?= date('F d, Y', strtotime($model->create_et)) ?><?= Html::a('&nbsp;&nbsp;&nbsp; <i class="fa fa-pencil"></i>&nbsp;&nbsp;Perbaharui', ['/guestbook/guestbook/update', 'action' => 'guestbook-update', 'id' => $model->id]) ?>&nbsp;&nbsp;
                       <?php
                        switch ($model->status) {
                            case 'Publish':
                                echo Html::tag('span', Html::tag('i', null, ['class' => 'fa  fa-check-circle-o']) . '&nbsp&nbsp' . $model->status, ['style' => 'color:#5ebd5e;']);
                                break;
                            case 'Draft':
                                echo Html::tag('span', Html::tag('i', null, ['class' => 'fa fa-bookmark-o']) . '&nbsp&nbsp' . $model->status, ['class' => 'badge badge-info']);
                                break;
                            case 'Unconfirmed':
                                echo Html::tag('span', Html::tag('i', null, ['class' => 'fa  fa-lock']) . '&nbsp&nbsp' . $model->status, ['style' => 'color:#e66454;']);
                                break;
                            case null;
                                break;
                        }
                        ?>
                    </p>
                    <?= $model->content ?>
                    <?php
            foreach ($child as $value):
                ?>
                <div class="media">               
                    <div class="pull-left">
                        <?=
                        \cebe\gravatar\Gravatar::widget([
                            'email' => $value->email,
                            'size' => 32,
                            'defaultImage' => 'mm',
                            'options' =>['class'=>'img-circle']
                        ]);
                        ?>
                    </div>
                    <div class="media-body">  
                        <p><?= $value->content ?><p>
                        <p style="font-size: 9px"><i class="fa fa-user"></i> &nbsp;<?= $value->name ?>&nbsp;&nbsp;&nbsp; <i class="fa fa-calendar"></i>&nbsp; <?= date('F d, Y', strtotime($value->create_et)) ?><?= Html::a('&nbsp;&nbsp;&nbsp; <i class="fa fa-pencil"></i>&nbsp;&nbsp;Perbaharui', ['/guestbook/guestbook/update', 'action' => 'guestbook-update', 'id' => $value->id]) ?> &nbsp;&nbsp;
                        <?php
                        switch ($value->status) {
                            case 'Publish':
                                echo Html::tag('span', Html::tag('i', null, ['class' => 'fa  fa-check-circle-o']) . '&nbsp&nbsp' . $value->status, ['style' => 'color:#5ebd5e;']);
                                break;
                            case 'Draft':
                                echo Html::tag('span', Html::tag('i', null, ['class' => 'fa fa-bookmark-o']) . '&nbsp&nbsp' . $value->status, ['class' => 'badge badge-info']);
                                break;
                            case 'Unconfirmed':
                                echo Html::tag('span', Html::tag('i', null, ['class' => 'fa  fa-lock']) . '&nbsp&nbsp' . $value->status, ['style' => 'color:#e66454;']);
                                break;
                            case null;
                                break;
                        }
                        ?>
                        </p>
                    </div> 
                </div>
            <?php endforeach; ?>
                </div> 
            </div>
            
            <div class="tl-entry">
                <div class="tl-icon bg-info"><i class="fa fa-comment"></i></div>
                <div class="panel tl-body">
                    <?php $form = ActiveForm::begin(); ?>
                    <?= Html::activeHiddenInput($model, 'user_id', ['value' => Yii::$app->user->getId()]) ?>
                    <?= Html::activeHiddenInput($model, 'parent_id', ['value' => $model->id]) ?>
                    <?= Html::activeHiddenInput($model, 'name', ['value' => Yii::$app->user->identity->username]) ?>
                    <?= Html::activeHiddenInput($model, 'email', ['value' => Yii::$app->user->identity->email]) ?>
                    <?= Html::activeHiddenInput($model, 'subject') ?>
                    <?= $model->setAttribute('content',null) ?>
                    <?= $form->field($model, 'content')->textarea(['placeholder'=>'Isi...','style' => 'resize:none', 'rows' => 6, 'maxlength' => 255])->label('<i class="fa fa-user"></i>&nbsp; ' . Yii::$app->user->identity->username) ?>

                    <div class="form-group">
                        <?= Html::submitButton('<i class="fa fa-check"></i>&nbsp; &nbsp;' . Yii::t('app', 'Replay'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>