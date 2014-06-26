<?php

use app\modules\dashboard\helpers\Navigation;
use Yii;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var \yii\web\View $this
 */
?>
<div id="main-navbar" class="navbar navbar-inverse" role="navigation">
    <!-- Main menu toggle -->
    <button type="button" id="main-menu-toggle"><i class="fa fa-bars icon"></i><span class="hide-menu-text">HIDE MENU</span></button>

    <div class="navbar-inner">
        <!-- Main navbar header -->
        <div class="navbar-header">


            <a class="navbar-brand" href="<?= Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard-list']) ?>"> 
                <div>
                    <img src="<?php echo Yii::getAlias('@web'); ?>/PixelAdmin/img/main-navbar-logo.png"/>
                </div>                                
                Paskibraka App
            </a>

            <!-- Main navbar toggle -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse"><i class="navbar-icon fa fa-bars"></i></button>

        </div> <!-- / .navbar-header -->

        <div id="main-navbar-collapse" class="collapse navbar-collapse main-navbar-collapse">
            <div>   
                <div class="right clearfix">
                    <ul class="nav navbar-nav pull-right right-navbar-nav">

                            <?php if (Yii::$app->user->can('dashboardloadmessage')): ?>
                            <li class="nav-icon-btn nav-icon-btn-success dropdown">                       
                                <?php
                                $this->registerJs('init.push(function() {
                                $("#main-navbar-messages").slimScroll({
                                    height: 300
                                }).bind("slimscroll", function(e, pos) {
                                    if (pos === "bottom") {                                            
                                        $("#img-messages-loading").css({"display":"block"});
                                        var pagedata = $("#main-navbar-messages").attr("page-data");
                                        $.ajax({
                                            url: "' . Url::toRoute(['/dashboard/dashboard/loadmessage']) . '",
                                            type: "get",
                                            data: {"page_id":pagedata},
                                            dataType: "json",
                                            success: function(response) {
                                                for(var i = 0; i < response.length; i++){
                                                    $("#main-navbar-messages").attr("page-data",response[i].pagedata);
                                                    if($("#main-navbar-messages").find(\'a[message-id="message-\'+response[i].dataid+\'"]\').length === 0){
                                                        if(response[i].status === "Unconfirmed"){
                                                            $("#main-navbar-messages").append(\'<a href="\'+response[i].url+\'" message-id="message-\'+response[i].dataid+\'"><div id="main-navbar-messages" class="messages-list" style="border-bottom: 1px solid; border-bottom-color:#ccc; background:#F3F2F2"><div class="message"> \' +response[i].img+ \'<span class="message-subject">\' +response[i].subject+ \'</span><div class="message-description"><span style="border-radius: 2px; padding-right:5px; padding-bottom:2px; padding-left:5px; background: #5bc0de; color:#fff">baru</span>&nbsp;dari &nbsp;\'+response[i].name+\'&nbsp;·&nbsp;\'+response[i].date+\'</div></div></div></a>\')
                                                        }else{
                                                            $("#main-navbar-messages").append(\'<a href="\'+response[i].url+\'" message-id="message-\'+response[i].dataid+\'"><div id="main-navbar-messages" class="messages-list" style="border-bottom: 1px solid; border-bottom-color:#ccc"><div class="message"> \' +response[i].img+ \'<span class="message-subject">\' +response[i].subject+ \'</span><div class="message-description">dari &nbsp;\'+response[i].name+\'&nbsp;·&nbsp;\'+response[i].date+\'</div></div></div></a>\')
                                                        }
                                                    }                                                    
                                                }
                                                $("#img-messages-loading").css({"display":"none"});
                                            }
                                        });
                                    }
                                });
                            });'
                                        , View::POS_READY);
                                ?>                       
                            <?= app\modules\dashboard\helpers\Message::widget() ?>
                            </li>
                        <?php endif; ?>
                        <!-- /3. $END_NAVBAR_ICON_BUTTONS -->

                        <li class="dropdown">
                            <a href="pages-blank.html#" class="dropdown-toggle user-menu" data-toggle="dropdown">
                                <?php
                                echo \cebe\gravatar\Gravatar::widget([
                                    'email' => Yii::$app->user->identity->email,
                                    'size' => 32,
                                    'defaultImage' => 'mm',
                                ])
                                ?>
                                <span><?= Yii::$app->user->identity->username ?></span>                               
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="pages-blank.html#">Profile <span class="label label-warning pull-right">new</span></a></li>
                                <li><a href="pages-blank.html#">Account <span class="badge badge-primary pull-right">new</span></a></li>
                                <li><a href="pages-blank.html#"><i class="dropdown-icon fa fa-cog"></i>&nbsp;&nbsp;Settings</a></li>
                                <li class="divider"></li>
                                <li><a data-confirm="Akan Keluar" data-method="post" href="<?= \yii\helpers\Url::toRoute('/user/security/logout'); ?>"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
                            </ul>
                        </li>
                    </ul> <!-- / .navbar-nav -->
                </div> <!-- / .right -->
            </div>
        </div> <!-- / #main-navbar-collapse -->
    </div> <!-- / .navbar-inner -->
</div> <!-- / #main-navbar -->