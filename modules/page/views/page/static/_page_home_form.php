<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\helpers\Url;

//use yii\imperavi\Widget as ImperaviWidget;
/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Post $model
 * @var yii\widgets\ActiveForm $form
 */
$this->registerCssFile(Yii::getAlias('@web') . '/jnestable/widgetnestable.css');
$this->registerJs(
    '$("#select-tag").select2({ allowClear: true, placeholder: "Tag ..."}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-status").select2({ allowClear: true, placeholder: "Tag ..."}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    , View::POS_READY);

//fost form validation
$this->registerJs(
    'init.push(function () { '
    . '$("body").on("click",".switcher-state-on",function(){'
    . '$("#img-slider").fadeOut();'
    . '});'
    . '$("body").on("click",".switcher-state-off",function(){'
    . '$("#img-slider").fadeIn();'
    . '});'
    . '$("#imgsliderstatus-id").switcher({'
    . 'theme: "square",'
    . '});'
    . 'var page_form = $("#page-form");'
    . 'page_form.validate({'
    . 'ignore: ".ignore",'
    . 'focusInvalid: true,'
    . 'rules:{'
    . '"PageModel[title]":{required: true, maxlength: 128},'
    . '"PageModel[status]":{required: true},'
    . '},'
    . 'messages: {'
    . '"PageModel[title]" : "Tidak boleh Kosong.",'
    . '"PageModel[status]" : "Tidak boleh Kosong.",'
    . '}'
    . '});'
    . '});'
    , View::POS_READY);

$this->registerJs(
    'var nestable_updatesort = function(jsonstring) {
            $.ajax({
                    url: "' . Url::toRoute(['/appearance/widget/updateposition', 'action' => 'appearance-widget-updateposition']) . '",
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
        nestableBuilder("#nestable-right");
        nestableBuilder("#nestable-left");
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
        '
    , View::POS_READY);
?>
<?php $form = ActiveForm::begin(['id' => 'page-form']); ?>
<div class="col-sm-8">
    <div class="form-group">
        <?= Html::activetextInput($model, 'title', ['class' => 'form-control', 'placeholder' => 'Judul . . .', 'maxlength' => 225]) ?>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-inline">
                        <input type="hidden" name="action" value="appearance-menu-list">
                        <div class="form-group">
                            <span>Tambahkan Widget:</span>
                            <a href="" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> &nbsp; Tambahkan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Widget Posisi Kiri</span>
                </div>
                <div class="panel-body padding-sm" >
                    <div class="dd" id="nestable-left">
                        <ol class="dd-list">
                            <?php foreach ($widgetleft as $left): ?>
                                <li class="dd-item" data-id="<?= $left->id ?>" data-position="<?= $left->position ?>" data-layoute="<?= $left->layoute_position ?>">
                                    <div class="dd-handle"><?= $left->name ?>
                                        <div class="pull-right action-buttons">
                                            <a class="select-tooltip" data-id="<?= $left->id ?>"
                                               data-toggle="tooltip" data-original-title="Perbaharui" href="<?= Url::toRoute(['/page/widget/update','action'=>'page-widget-update','id'=>$left->id])?>">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a style="color: #a94442 " class="widget-delete select-tooltip" data-id="<?= $left->id ?>"
                                               data-toggle="tooltip" data-original-title="Hapus" href="javascript:undefined;">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="button" class="btn btn-xs btn-primary" id="btn-left-save"><i class="fa fa-check"></i>&nbsp; Simpan</button>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Widget Posisi Kanan</span>
                </div>
                <div class="panel-body padding-sm" >
                    <div class="dd" id="nestable-right">
                        <ol class="dd-list">
                            <?php foreach ($widgetright as $right): ?>
                                <li class="dd-item" data-id="<?= $right->id ?>" data-position="<?= $right->position ?>" data-layoute="<?= $right->layoute_position ?>">
                                    <div class="dd-handle"><?= $right->name ?>
                                        <div class="pull-right action-buttons">
                                            <a class="select-tooltip" data-id="<?= $right->id ?>"
                                               data-toggle="tooltip" data-original-title="Perbaharui" href="<?= Url::toRoute(['/page/widget/update','action'=>'page-widget-update','id'=>$right->id])?>">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a style="color: #a94442 " class="widget-delete select-tooltip" data-id="<?= $right->id ?>"
                                               data-toggle="tooltip" data-original-title="Hapus" href="javascript:undefined;">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="button" class="btn btn-xs btn-primary" id="btn-right-save"><i class="fa fa-check"></i>&nbsp; Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-4">

    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title">Sidebar</span>
        </div>
        <div class="panel-body">
            <div class="form-group">

            </div>
        </div>
        <div class="panel-footer">
            <button class="btn btn-xs btn-primary" id="btn-sidebar-save"><i class="fa fa-check"></i>&nbsp; Simpan</button>
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

