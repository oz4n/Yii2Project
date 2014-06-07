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
                <li><a href="page_faq.html"><i class="fa  fa-facebook-square" style="font-size: 12px;color:#46629e "></i>&nbsp;Facebook</a></li>  
                <li class="topbar-devider"></li>   
                <li><a href="page_faq.html"><i class="fa  fa-google-plus-square" style="font-size: 12px; color:#df5138"></i>&nbsp;Google+</a></li>  
                <li class="topbar-devider"></li>   
                <li><a href="page_faq.html"><i class="fa  fa-twitter-square" style="font-size: 12px; color: #55acee"></i>&nbsp;Twiter</a></li>                  
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
            </div><!--/navbar-collapse-->
        </div>    
    </div>            
    <!-- End Navbar -->
</div>
<!--=== End Header ===-->    