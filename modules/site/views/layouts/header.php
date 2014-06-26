<?php

use app\modules\site\helpers\Navigation;
use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this 
 */

$this->registerJs(
        '$("#user-logoute").click(function(){'
        . ' jQuery.ajax({'
                .'url: "' . Url::toRoute(['/user/security/logout']) . '",'
                .'type:"post",'
                .'dataType:"json",'
                .'data:{'
                    .'"' . \Yii::$app->request->csrfParam . '" : "' . \Yii::$app->request->getCsrfToken() . '"'
                .'},'
                
                .'success:function(response){'
                    .'var urlredirect= "' . \Yii::$app->request->getHostInfo() . '";'
                    .'window.location.replace(urlredirect);'
                .'}'
        . '}); '
        . '});'
        , View::POS_END);

?> 
<div class="header">
    <?php if (!Yii::$app->user->isGuest): ?>
        <div class="topbar-v1 margin-bottom-10">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled top-v1-data">
                            <li style="border: none">
                                <?php
                                switch (Yii::$app->user->identity->role) {
                                    case "ppimember":
                                        echo Html::a('<i class="fa fa-dashboard"></i> Beranda', ['/site/member/index', 'role' => Yii::$app->user->identity->role, 'slug' => Yii::$app->user->identity->slug]);
                                        break;
                                    case "capasmember":
                                        echo Html::a('<i class="fa fa-dashboard"></i> Beranda', ['/site/member/index', 'role' => Yii::$app->user->identity->role, 'slug' => Yii::$app->user->identity->slug]);
                                        break;
                                    case "paskibramember":
                                        echo Html::a('<i class="fa fa-dashboard"></i> Beranda', ['/site/member/index', 'role' => Yii::$app->user->identity->role, 'slug' => Yii::$app->user->identity->slug]);
                                        break;
                                    default :
                                        echo Html::a('<i class="fa fa-dashboard"></i> Beranda', ['/dashboard/dashboard/index', 'action' => 'dashboard-list']);
                                        break;
                                }
                                ?>

                            </li> 
                            <li style="border: none">
                                <a href="#">
                                    <i class="fa fa-user"></i> <?= Yii::$app->user->identity->username ?>
                                </a>
                            </li>
                            <li style="border: none">
                                <?= Html::a('<i class="fa fa-lock"></i> Logout', '#', ['id' => 'user-logoute']); ?>                                
                            </li>
                        </ul>
                    </div>
                </div>        
            </div>
        </div>
    <?php endif; ?>
    <div class="topbar">
        <div class="container">

            <ul class="loginbar pull-right">                                                        
                <li> <a target="_blank" href="<?= Yii::$app->params['facebook_link'] ?>"><i class="fa  fa-facebook-square" style="font-size: 12px;color:#46629e "></i>&nbsp;Facebook</a></li>  
                <li class="topbar-devider"></li>   
                <li><a target="_blank" href="<?= Yii::$app->params['google_plus_link'] ?>"><i class="fa  fa-google-plus-square" style="font-size: 12px; color:#df5138"></i>&nbsp;Google+</a></li>  
                <li class="topbar-devider"></li>   
                <li><a target="_blank" href="<?= Yii::$app->params['twitter_link'] ?>"><i class="fa  fa-twitter-square" style="font-size: 12px; color: #55acee"></i>&nbsp;Twiter</a></li>                  
            </ul>

        </div>
    </div>

    <div class="navbar navbar-default" role="navigation">
        <div class="container">   

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="sr-only"></span>
                    <span class="fa fa-bars"></span>
                </button>
                <a class="navbar-brand" href="<?php echo Yii::$app->homeUrl; ?>">
                    <img id="logo-header" src="<?php echo Yii::getAlias('@web'); ?>/site/img/paskibraka.png" >
                </a>
            </div>
            <div class="collapse navbar-collapse navbar-responsive-collapse">               
                <?php
                if ((Navigation::getMenuByHeaderTerm() !== null) && (Navigation::getMenuByHeaderTerm()->status === "Publish")) {
                    echo Navigation::widget([
                        'taxmenuid' => Navigation::getMenuByHeaderTerm()->id,
                        'options' => [
                            'class' => 'nav navbar-nav',
                            'style' => "margin-right: -15px;"
                        ]
                    ]);
                }
                ?>
            </div>
        </div>    
    </div>
</div>   