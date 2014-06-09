<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\appearance\searchs\WidgetSearc $searchModel
 */
$this->title = Yii::t('app', 'Widgets');
$this->registerJs(
    "$('ul.navigation > li.mm-dropdown > ul > li#widget').addClass('active').parent().parent().addClass('active open');"
    , View::POS_READY);
$this->registerCssFile(Yii::getAlias('@web') . '/jnestable/widgetnestable.css');
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
                if(id === "#nestable-sidebar"){
                     $(listdata[i]).attr("data-position",i);
                     $(listdata[i]).attr("data-layoute","sidebar");
                }else{
                     $(listdata[i]).attr("data-position",i);
                     $(listdata[i]).attr("data-layoute","footer");
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
        };
        nestableBuilder("#nestable-sidebar");
        nestableBuilder("#nestable-footer");
        $("body").on("click","#btn-footer-save",function(){
            var e = $("#nestable-footer").data("output", $("#nestableMenu-output"));
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
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?php echo Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?php echo Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard']); ?>"><?php echo Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li class="active">
        Widget
    </li>
</ul>


<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa  fa-sitemap page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Widget') ?>
            </h1>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="panel widget-followers">
            <div class="panel-heading">
                <span class="panel-title">Widget yang tersedia</span>
            </div>
            <div class="panel-body">
                <?php foreach ($defaultwidget as $value): ?>
                    <div class="follower">
                        <div class="body">
                            <div class="follower-controls">
                                <?= Html::a('<i class="fa fa-plus"></i><span>&nbsp;&nbsp;Tambahkan</span>', '#', ['class' => 'btn btn-xs btn-primary']) ?>
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

    <div class="col-sm-4">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">Sidebar</span>
            </div>
            <div class="panel-body padding-sm" >
                <div class="dd" id="nestable-sidebar">
                    <ol class="dd-list">
                        <?php foreach ($sidebarwidget as $sidebar): ?>
                            <li class="dd-item" data-id="<?= $sidebar->id ?>" data-position="<?= $sidebar->position ?>" data-layoute="<?= $sidebar->layoute_position ?>">
                                <div class="dd-handle"><?= $sidebar->name ?>
                                    <div class="pull-right action-buttons">
                                        <a style="color: #a94442 " class="menu-delete select-tooltip" data-id="128"
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
                <button class="btn btn-xs btn-primary" id="btn-sidebar-save"><i class="fa fa-check"></i>&nbsp; Simpan</button>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel widget-notifications">
            <div class="panel-heading">
                <span class="panel-title">Footer</span>
            </div>

            <div class="panel-body padding-sm" >
                <div class="dd" id="nestable-footer">
                    <ol class="dd-list">
                        <?php foreach ($footerwidget as $footer): ?>
                            <li class="dd-item" data-id="<?= $footer->id ?>" data-position="<?= $footer->position ?>" data-layoute="<?= $footer->layoute_position ?>">
                            <div class="dd-handle"><?= $footer->name ?>
                                <div class="pull-right action-buttons">
                                    <a style="color: #a94442 " class="menu-delete select-tooltip" data-id="128"
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
                <button class="btn btn-xs btn-primary" id="btn-footer-save"><i class="fa fa-check"></i>&nbsp; Simpan</button>
            </div>
        </div>
    </div>
</div>

