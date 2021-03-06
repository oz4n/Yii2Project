<?php

use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\helpers\Url;
$this->registerCssFile(Yii::getAlias('@web') . '/jnestable/widgetnestable.css');
//use yii\imperavi\Widget as ImperaviWidget;
/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Post $model
 * @var yii\widgets\ActiveForm $form
 */
//delte menu item
$this->registerJs(
        '$("body").on("click",".widget-delete",function(){'
        . 'console.log(this);'
        . 'var data_id = $(this).attr("data-id");'
        . '$(this).parent().parent().parent().remove();'
        . '$.ajax({
                url: "' . Url::toRoute(['/page/widget/deletewidgetitem', 'action' => 'appearance-widget-deleteitem']) . '",
                type:"post",
                data:{
                    "dataid":data_id,
                    "' . Yii::$app->request->csrfParam . '" : "' . Yii::$app->request->getCsrfToken() . '"
                },
                dataType:"json",
                success:function(response){
                    $("html,body").animate({ scrollTop: 0 }, 500);
                        PixelAdmin.plugins.alerts.add("<strong>Sukses!</strong>&nbsp;" + response.text, {
                            type:"success",
                            auto_close:9
                       });
                }
            });'
        . 'return false;'
        . '});'
        , View::POS_READY);
$this->registerJs(
        'var nestable_updatesort = function(jsonstring) {
            $.ajax({
                    url: "' . Url::toRoute(['/page/widget/updateposition', 'action' => 'page-widget-updateposition']) . '",
                    type: "POST",
                    dataType: "json",
                    data: {
                        data: jsonstring,
                        "' . Yii::$app->request->csrfParam . '" : "' . Yii::$app->request->getCsrfToken() . '",
                    },
                    success: function(response) {
                        $("html,body").animate({ scrollTop: 0 }, 500);
                        PixelAdmin.plugins.alerts.add("<strong>Sukses!</strong>&nbsp;" + response.text, {
                            type:"success",
                            auto_close:9
                       });
                    }
            });
        };
        
        var updateOutput = function(id)
        {
            var listdata = $(id + " .dd-list").find("li");
            for(var i = 0; i < listdata.length; i++){
                if(id === "#nestable-left"){
                     $(listdata[i]).attr("data-position",i);
                     $(listdata[i]).attr("data-layoute","homeleft");
                }else if(id === "#nestable-right"){
                     $(listdata[i]).attr("data-position",i);
                     $(listdata[i]).attr("data-layoute","homeright");
                }

            }
        };

        var nestableBuilder = function(id) {
            $(id).nestable({
                group: 1,
                handleClass     : "dd-handle",
                listNodeName    : "ol",
                itemNodeName    : "li",
                expandBtnHTML : "",
                collapseBtnHTML : ""
            }).on("change", function(){updateOutput(id);});
            $(".dd-handle a").on("mousedown", function(e){
                    e.stopPropagation();
            });
        };
      
        nestableBuilder("#nestable-sidebar");
        $("body").on("click","#btn-right-save",function(){
            var e = $("#nestable-right").data("output", $("#nestableMenu-output"));
            var list = e.length ? e : $(e.target);
            nestable_updatesort(window.JSON.stringify(list.nestable("serialize")));
        });

        $("body").on("click","#btn-left-save",function(){
            var e = $("#nestable-left").data("output", $("#nestableMenu-output"));
            var list = e.length ? e : $(e.target);
            nestable_updatesort(window.JSON.stringify(list.nestable("serialize")));
        });
        $("body").on("click","#btn-sidebar-save",function(){
            var e = $("#nestable-sidebar").data("output", $("#nestableMenu-output"));
            var list = e.length ? e : $(e.target);
            nestable_updatesort(window.JSON.stringify(list.nestable("serialize")));
        });
        '
        , View::POS_READY);
?>

<?php $form = ActiveForm::begin(['id' => 'page-form']); ?>
<div class="col-sm-8">
    <div class="form-group">
        <?= Html::activeHiddenInput($model, 'type') ?>
        <?= Html::activeHiddenInput($model, 'imgslider', ['id' => 'img-slider-value', 'value' => isset($other->imgslider) ? json_encode($other->imgslider) : ""]) ?>
        <?= Html::activetextInput($model, 'title', ['class' => 'form-control', 'placeholder' => 'Judul . . .', 'maxlength' => 225]) ?>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel widget-followers">
                <div class="panel-heading">
                    <span class="panel-title">Widget yang tersedia</span>
                </div>
                <div class="panel-body">
                    <?php foreach ($defaultwidget as $value): ?>
                        <div class="follower">
                            <div class="body">
                                <div class="follower-controls">
                                    <?= Html::a('<i class="fa fa-plus"></i><span>&nbsp;&nbsp;Tambahkan</span>', ['/page/widget/create', 'action' => 'page-widget-crete', 'id' => $value->id, 'page' => $page, 'pagename' => $pagename,'pagetype'=>$pagetype], ['class' => 'btn btn-xs btn-primary']) ?>
                                </div>
                                <p>
                                    <span class="follower-name"><?= $value->name ?></span><br>
                                    <span class="follower-username"><?= $value->content ?></span>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="col-sm-4">

   
    <!--start sidebar-->
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title">Sidebar</span>
        </div>
        <div class="panel-body">
            <div class="dd" id="nestable-sidebar">
                <ol class="dd-list">
                    <?php
                    foreach ($widgetsidebar as $sidebar):
                        ?>
                        <li class="dd-item" data-id="<?= $sidebar->id ?>" data-position="<?= $sidebar->position ?>" data-layoute="<?= $sidebar->layoute_position ?>">
                            <div class="dd-handle"><?= $sidebar->name ?>
                                <div class="pull-right action-buttons">
                                    <a class="select-tooltip" data-id="<?= $sidebar->id ?>"
                                       data-toggle="tooltip" data-original-title="Perbaharui" href="<?= Url::toRoute(['/page/widget/update', 'action' => 'page-widget-update', 'id' => $sidebar->id, 'page' => $page, 'pagename' => $pagename,'pagetype'=>$pagetype]) ?>">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a style="color: #a94442 " class="widget-delete select-tooltip" data-id="<?= $sidebar->id ?>"
                                       data-toggle="tooltip" data-original-title="Hapus" href="javascript:undefined;">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <?php
                    endforeach;
                    ?>
                </ol>
            </div>
        </div>
        <div class="panel-footer">
            <button type="button" class="btn btn-xs btn-primary" id="btn-sidebar-save"><i class="fa fa-check"></i>&nbsp; Simpan</button>
        </div>
    </div>
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title">Layout</span>
        </div>
        <div class="panel-body">
            <?=
            $form->field($model, 'layout')->dropDownList([
                'full' => 'Full',
                'right' => 'Kanan',
                'left' => 'Kiri'
                    ], ['id' => 'select-status', 'maxlength' => 15]);
            ?>             
        </div>
    </div>
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title">Aksi</span>
        </div>
        <div class="panel-body">
            <?=
            $form->field($model, 'status')->dropDownList([
                '' => 'None',
                'Publish' => 'Publish',
                'Draft' => 'Draft',
                'Trash' => 'Trash'
                    ], ['id' => 'select-status', 'maxlength' => 15]);
            ?>
        </div>
        <div class="panel-footer">
            <div class="form-group">
                <?= Html::submitButton(Html::tag('i', '', ['class' => 'fa  fa-check']) . '&nbsp; ' . Yii::t('app', 'Simpan'), ['id' => 'save-page', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
