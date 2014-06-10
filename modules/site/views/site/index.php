<?php
use app\modules\site\widgets\RenderWidget;

/* Slider */
echo $this->render('slider');
?>

<div class="container content">
    <!--<div class="clearfix margin-bottom-20"></div>-->
    <div class="shadow-wrapper">
        <div class="tag-box tag-box-v1 box-shadow shadow-effect-2">
            <h2>Kata mutiara hari ini</h2>
            <p>Hidup ini bukan hanya mencari yang terbaik, namun lebih kepada menerima kenyataan bahwa kamu adalah kamu. Jadi dirimu sendiri. @Iwan False</p>
        </div>      
    </div>
    <!--    <div class="shadow-wrapper">
            <blockquote class="tag-box tag-box-v1 box-shadow shadow-effect-2">
                <h2>Kata mutiara hari ini</h2>
                <p>Hidup ini bukan hanya mencari yang terbaik, namun lebih kepada menerima kenyataan bahwa kamu adalah kamu. Jadi dirimu sendiri.</p>
                <small>Iwan Fals</small>
            </blockquote>
        </div>-->
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6">
                    <?=
                    RenderWidget::widget(['colClass'=>'col-sm-12 margin-bottom-20 ','layoute_position' => 'homeleft']);
                    ?>
                </div>
                <!--Info Block-->
                <div class="col-md-6">
                    <?=
                    RenderWidget::widget(['colClass'=>'col-sm-12 margin-bottom-20 ','layoute_position' => 'homeright']);
                    ?>
                </div>
                <!--End Info Block-->
            </div>
        </div>
        <div class="col-md-3">
            <!-- Blog Twitter -->
            <div class="blog-twitter">
                <div class="headline headline-md"><h2>Buku Tamu</h2></div>
                <div class="blog-twitter-inner">
                    <i class="fa fa-comment-o"></i>
                    <a href="blog_large.html#">@htmlstream</a> 
                    At vero eos et accusamus et iusto odio dignissimos. 
                    <a href="blog_large.html#">http://t.co/sBav7dm</a> 
                    <span>5 hours ago</span>
                </div>
                <div class="blog-twitter-inner">
                    <i class="fa fa-comment-o"></i>
                    <a href="blog_large.html#">@htmlstream</a> 
                    At vero eos et accusamus et iusto odio dignissimos. 
                    <a href="blog_large.html#">http://t.co/sBav7dm</a> 
                    <span>5 hours ago</span>
                </div>
                <div class="blog-twitter-inner">
                    <i class="fa fa-comment-o"></i>
                    <a href="blog_large.html#">@htmlstream</a> 
                    At vero eos et accusamus et iusto odio dignissimos. 
                    <a href="blog_large.html#">http://t.co/sBav7dm</a> 
                    <span>5 hours ago</span>
                </div>
                <div class="blog-twitter-inner">
                    <i class="fa fa-comment-o"></i>
                    <a href="blog_large.html#">@htmlstream</a> 
                    At vero eos et accusamus et iusto odio dignissimos. 
                    <a href="blog_large.html#">http://t.co/sBav7dm</a> 
                    <span>5 hours ago</span>
                </div>
            </div>
            <!-- End Blog Twitter -->
        </div>
    </div>
</div>
