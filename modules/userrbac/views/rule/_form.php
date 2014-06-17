<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use app\modules\userrbac\search\RuleSerch;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\AuthItem $model
 * @var yii\widgets\ActiveForm $form
 */
$this->registerJs(
        "$('ul.navigation > li#user > ul.mm-dropdown > li#rule-account').addClass('active').parent().addClass('open').parent().addClass('active open');"
        , View::POS_READY);
$this->registerJs(
        'init.push(function () { '
        . '$("ul.bs-tabdrop").tabdrop();'
//        . '$("#rules-id").slimScroll({ height: 700 });'
        . '});'
        , View::POS_READY);
?>

<?php
$form = ActiveForm::begin();
?>


<div class="col-sm-8">
    <ul class="nav nav-tabs bs-tabdrop">
        <li class="active">
            <a href="#bs-tabdrop-tab1" data-toggle="tab"><i class="fa fa-briefcase"></i>&nbsp;Beranda</a>
        </li>
        <li class="">
            <a href="#bs-tabdrop-tab2" data-toggle="tab"><i class="fa fa-archive"></i>&nbsp;Database</a>
        </li>
        <li class="">
            <a href="#bs-tabdrop-tab3" data-toggle="tab"><i class="fa fa-pencil"></i>&nbsp;Tulisan</a>
        </li>
        <li class="">
            <a href="#bs-tabdrop-tab4" data-toggle="tab"><i class="fa fa-files-o"></i>&nbsp;Halaman</a>
        </li>
        <li class="">
            <a href="#bs-tabdrop-tab5" data-toggle="tab"><i class="fa fa-briefcase"></i>&nbsp;Media</a>
        </li>
        <li class="">
            <a href="#bs-tabdrop-tab6" data-toggle="tab"><i class="fa fa-leaf"></i>&nbsp;Tampilan</a>
        </li>
        <li class="">
            <a href="#bs-tabdrop-tab7" data-toggle="tab"><i class="fa fa-comments-o"></i>&nbsp;Buku Tamu</a>
        </li>
        <li class="">
            <a href="#bs-tabdrop-tab8" data-toggle="tab"><i class="fa fa-user-md"></i>&nbsp;Pengguna</a>
        </li>
    </ul>

    <div id="rules-id" class="tab-content tab-content-bordered" style="background-color: #fff">            
        <div class="tab-pane fade in active" id="bs-tabdrop-tab1">
            <div class="timeline">
                <div class="tl-header now"><i class="fa fa-briefcase"></i>&nbsp; Beranda</div>
                <?=
                $this->render('_dashboard', ['ruleparent' => $ruleparent, 'model' => $model]);
                ?>
            </div>
        </div>
        <div class="tab-pane fade" id="bs-tabdrop-tab2">

            <div class="timeline">                       
                <div class="tl-header now"><i class="fa fa-archive"></i>&nbsp; Database</div>
                <?=
                $this->render('_database', ['ruleparent' => $ruleparent, 'model' => $model]);
                ?>
            </div>

        </div>
        <div class="tab-pane fade" id="bs-tabdrop-tab3">
            <div class="timeline">                       
                <div class="tl-header now"><i class="fa fa-pencil"></i>&nbsp; Tulisan</div>
                <?=
                $this->render('_post', ['ruleparent' => $ruleparent, 'model' => $model]);
                ?>
            </div>
        </div>
        <div class="tab-pane fade" id="bs-tabdrop-tab4">
            <div class="timeline">                       

                <div class="tl-header now"><i class="fa fa-files-o"></i>&nbsp; Halaman</div>
                <?=
                $this->render('_page', ['ruleparent' => $ruleparent, 'model' => $model]);
                ?>
            </div>
        </div>
        <div class="tab-pane fade" id="bs-tabdrop-tab5">
            <div class="timeline">                      

                <div class="tl-header now"><i class="fa fa-briefcase"></i>&nbsp; Media</div>
                <?=
                $this->render('_media', ['ruleparent' => $ruleparent, 'model' => $model]);
                ?>
            </div>
        </div>
        <div class="tab-pane fade" id="bs-tabdrop-tab6">
            <div class="timeline">                     

                <div class="tl-header now"><i class="fa fa-leaf"></i>&nbsp; Tampilan</div>
                <?=
                $this->render('_appearance', ['ruleparent' => $ruleparent, 'model' => $model]);
                ?>               


            </div>
        </div>
        <div class="tab-pane fade" id="bs-tabdrop-tab7">
            <div class="timeline">    
                <div class="tl-header now"><i class="fa fa-comments-o"></i>&nbsp; Buku Tamu</div>
                <?=
                $this->render('_guestbook', ['ruleparent' => $ruleparent, 'model' => $model]);
                ?>
            </div>
        </div>
        <div class="tab-pane fade" id="bs-tabdrop-tab8">
            <div class="timeline">                       
                <div class="tl-header now"><i class="fa fa-user-md"></i>&nbsp; Pengguna</div>
                <?=
                $this->render('_user', ['ruleparent' => $ruleparent, 'model' => $model]);
                ?>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="panel">
        <div class="panel-body">
            <?= $form->field($model, 'description')->textInput(['rows' => 6])->label("Nama Rule") ?>
        </div>
         <div class="panel-footer">
        <?= Html::submitButton('<i class="fa fa-check"></i>&nbsp; ' . Yii::t('app', 'Simpan'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>   
</div>
<?php ActiveForm::end(); ?>


