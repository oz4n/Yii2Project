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
    <button type="button" id="main-menu-toggle"><i class="navbar-icon fa fa-bars icon"></i><span class="hide-menu-text">HIDE MENU</span></button>

    <div class="navbar-inner">
        <!-- Main navbar header -->
        <div class="navbar-header">


            <a class="navbar-brand" href="#">
                <div>
                    <img src="<?php echo Yii::getAlias('@web'); ?>/PixelAdmin/img/main-navbar-logo.png" alt="Zend Framework 2" />
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

                        
                    <li class="nav-icon-btn nav-icon-btn-danger dropdown">
                        <a href="pages-blank.html#notifications" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="label">5</span>
                            <i class="nav-icon fa fa-bullhorn"></i>
                            <span class="small-screen-text">Notifications</span>
                        </a>

                        <!-- NOTIFICATIONS -->

                        <!-- Javascript -->
                        <script>
                            init.push(function() {
                                $('#main-navbar-notifications').slimScroll({height: 250});
                            });
                        </script>
                        <!-- / Javascript -->

                        <div class="dropdown-menu widget-notifications no-padding" style="width: 300px">
                            <div class="notifications-list" id="main-navbar-notifications">

                                <div class="notification">
                                    <div class="notification-title text-danger">SYSTEM</div>
                                    <div class="notification-description"><strong>Error 500</strong>: Syntax error in index.php at line <strong>461</strong>.</div>
                                    <div class="notification-ago">12h ago</div>
                                    <div class="notification-icon fa fa-hdd-o bg-danger"></div>
                                </div> <!-- / .notification -->

                                <div class="notification">
                                    <div class="notification-title text-info">STORE</div>
                                    <div class="notification-description">You have <strong>9</strong> new orders.</div>
                                    <div class="notification-ago">12h ago</div>
                                    <div class="notification-icon fa fa-truck bg-info"></div>
                                </div> <!-- / .notification -->

                                <div class="notification">
                                    <div class="notification-title text-default">CRON DAEMON</div>
                                    <div class="notification-description">Job <strong>"Clean DB"</strong> has been completed.</div>
                                    <div class="notification-ago">12h ago</div>
                                    <div class="notification-icon fa fa-clock-o bg-default"></div>
                                </div> <!-- / .notification -->

                                <div class="notification">
                                    <div class="notification-title text-success">SYSTEM</div>
                                    <div class="notification-description">Server <strong>up</strong>.</div>
                                    <div class="notification-ago">12h ago</div>
                                    <div class="notification-icon fa fa-hdd-o bg-success"></div>
                                </div> <!-- / .notification -->

                                <div class="notification">
                                    <div class="notification-title text-warning">SYSTEM</div>
                                    <div class="notification-description"><strong>Warning</strong>: Processor load <strong>92%</strong>.</div>
                                    <div class="notification-ago">12h ago</div>
                                    <div class="notification-icon fa fa-hdd-o bg-warning"></div>
                                </div> <!-- / .notification -->

                            </div> <!-- / .notifications-list -->
                            <a href="pages-blank.html#" class="notifications-link">INFO SELENGKAPNYA</a>
                        </div> <!-- / .dropdown-menu -->
                    </li>
                    
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
                                            url: "'.Url::toRoute(['/dashboard/dashboard/loadmessage']).'",
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
                    <!-- /3. $END_NAVBAR_ICON_BUTTONS -->

                        <li class="dropdown">
                            <a href="pages-blank.html#" class="dropdown-toggle user-menu" data-toggle="dropdown">
                                <img src="<?php echo Yii::getAlias('@web'); ?>/PixelAdmin/img/avatars/1.jpg" alt="">
                                <span><?= Yii::$app->user->identity->username ?></span>
                                <span><?= Yii::$app->user->identity->getId() ?></span>
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