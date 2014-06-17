<?php
Use app\modules\site\widgets\RenderWidget;
$this->title = "Kontak";
$this->registerMetaTag(['name' => 'keywords', 'content' =>'kontak']);

?>
<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
    <div class="container">
        <h1 class="pull-left">Kontak Kami</h1>
        <ul class="pull-right breadcrumb">
            <li><a href="#">Home</a></li>              
            <li class="active">Kontak kami</li>
        </ul>
    </div>
</div>
<!--/breadcrumbs-->
<!--=== End Breadcrumbs ===-->
<div class="container content">
    <div class="row">
        <div class="col-md-8 mb-margin-bottom-30">
            <!-- Google Map -->
            <div class="blog-img margin-bottom-30">
                <img class="img-responsive" src="<?php echo Yii::getAlias('@web'); ?>/unify-v1.4/img/map.png" alt="">
            </div>
            <!-- End Google Map -->          
            <?php if(\Yii::$app->session->getFlash('success') !== null):?>
            <div class="alert alert-success fade in">
                <strong>Terimakasih!</strong> <?= Yii::$app->session->getFlash('success')?>
            </div>
            <?php else:?>
            <div class="tag-box tag-box-v4">
                <strong>Info!</strong> Silahkan para pengunjung sekalian memberikan penilaian, kritik dan saran yang membangun pada form berikut ini.
            </div>
            <?php endif;?>
            <?php
            $form = yii\widgets\ActiveForm::begin()
            ?>
            <?= $form->field($model, 'name')->textInput()->label('Nama') ?>
            <?= $form->field($model, 'email')->textInput() ?>
            <?= $form->field($model, 'subject')->textInput()->label('Subjek') ?>
            <?= $form->field($model, 'content')->textarea(['rows' => 7, 'style' => 'resize:none'])->label('Pesan') ?>
            <div class="form-group margin-bottom-30">
                <?= yii\helpers\Html::button('<i class="fa fa-check"></i>&nbsp; Kirim pesan', ['class' => 'btn-u']) ?>
            </div>
            <?php yii\widgets\ActiveForm::end() ?>
        </div>
       <div class="col-md-4 magazine-page">
            <div class="row">
                <?=
                RenderWidget::widget(['colClass' => 'col-sm-12 margin-bottom-20 ', 'layoute_position' => 'contactsidebar', 'tax' => $param['tax']]);
                ?>
            </div>
        </div>

    </div>
</div>
