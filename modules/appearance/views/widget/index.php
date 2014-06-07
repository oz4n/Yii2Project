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
    <div class="col-sm-9">
        <div class="row">
            <div class="col-sm-4">
                <div class="panel colourable">
                    <div class="panel-heading">
                        <span class="panel-title">Pencarian postingan</span>

                    </div>
                    <div class="panel-body">
                        Panel body content
                    </div>
                    <div class="panel-footer">
                        <div class="text-right-sm">                            
                            <button class="btn btn-primary btn-xs"><i class="fa fa-plus"></i>&nbsp; Tambahkan</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="panel colourable">
                    <div class="panel-heading">
                        <span class="panel-title">Informasi Terbaru</span>
                    </div>
                    <div class="panel-body">
                        Panel body content
                    </div>
                    <div class="panel-footer">
                        <div class="text-right-sm">                            
                            <button class="btn btn-primary btn-xs"><i class="fa fa-plus"></i>&nbsp; Tambahkan</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="panel colourable">
                    <div class="panel-heading">
                        <span class="panel-title">Kategori</span>
                    </div>
                    <div class="panel-body">
                        Panel body content
                    </div>
                    <div class="panel-footer">
                        <div class="text-right-sm">                            
                            <button class="btn btn-primary btn-xs"><i class="fa fa-plus"></i>&nbsp; Tambahkan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <h1>Footer</h1>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="panel colourable">
                            <div class="panel-heading">
                                <span class="panel-title">Widget 3</span>
                            </div>
                            <div class="panel-body">
                                Panel body content
                            </div>
                        </div>
                    </div>   
                    <div class="col-sm-4">
                        <div class="panel colourable">
                            <div class="panel-heading">
                                <span class="panel-title">Widget 3</span>
                            </div>
                            <div class="panel-body">
                                Panel body content
                            </div>
                        </div>
                    </div>   
                    <div class="col-sm-4">
                        <div class="panel colourable">
                            <div class="panel-heading">
                                <span class="panel-title">Widget 3</span>
                            </div>
                            <div class="panel-body">
                                Panel body content
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">        
        <div class="row">
            <div class="col-sm-12">
                <div class="panel colourable">
                    <div class="panel-heading">
                        <span class="panel-title">Widget 3</span>
                    </div>
                    <div class="panel-body">
                        Panel body content
                    </div>
                </div>
            </div>            
        </div> 
        <div class="row">
            <div class="col-sm-12">
                <div class="panel colourable">
                    <div class="panel-heading">
                        <span class="panel-title">Widget 3</span>
                    </div>
                    <div class="panel-body">
                        Panel body content
                    </div>
                </div>
            </div>            
        </div> 
        <div class="row">
            <div class="col-sm-12">
                <div class="panel colourable">
                    <div class="panel-heading">
                        <span class="panel-title">Widget 3</span>
                    </div>
                    <div class="panel-body">
                        Panel body content
                    </div>
                </div>
            </div>            
        </div> 
        <div class="row">
            <div class="col-sm-12">
                <div class="panel colourable">
                    <div class="panel-heading">
                        <span class="panel-title">Widget 3</span>
                    </div>
                    <div class="panel-body">
                        Panel body content
                    </div>
                </div>
            </div>            
        </div> 
        <div class="row">
            <div class="col-sm-12">
                <div class="panel colourable">
                    <div class="panel-heading">
                        <span class="panel-title">Widget 3</span>
                    </div>
                    <div class="panel-body">
                        Panel body content
                    </div>
                </div>
            </div>            
        </div> 
    </div>
</div>

