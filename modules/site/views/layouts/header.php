<?php
use app\modules\site\helpers\Navigation;
/**
 * @var \yii\web\View $this
 */
?>
<!--=== Header ===-->    
<div class="header">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <!-- Topbar Navigation -->
            <ul class="loginbar pull-right">
                <li>
                    <i class="fa fa-globe"></i>
                    <a>Languages</a>
                    <ul class="lenguages">
                        <li class="active">
                            <a href="page_home2.html#">English <i class="fa fa-check"></i></a> 
                        </li>
                        <li><a href="page_home2.html#">Spanish</a></li>
                        <li><a href="page_home2.html#">Russian</a></li>
                        <li><a href="page_home2.html#">German</a></li>
                    </ul>
                </li>
                <li class="topbar-devider"></li>   
                <li><a href="page_faq.html">Help</a></li>  
                <li class="topbar-devider"></li>   
                <li><a href="page_login.html">Login</a></li>   
            </ul>
            <!-- End Topbar Navigation -->
        </div>
    </div>
    <!-- End Topbar -->

    <!-- Navbar -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">    

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="sr-only"></span>
                    <span class="fa fa-bars"></span>
                </button>
                <a class="navbar-brand" href="<?php echo Yii::$app->homeUrl; ?>">
                    <img id="logo-header" src="<?php echo Yii::getAlias('@web'); ?>/unify-v1.4/img/paskibraka.png" alt="Logo">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-responsive-collapse">               
                <?php
                echo Navigation::widget([
                    'options' => ['class' => 'nav navbar-nav']
                ]);
                ?>
            </div><!--/navbar-collapse-->
        </div>    
    </div>            
    <!-- End Navbar -->
</div>
<!--=== End Header ===-->    