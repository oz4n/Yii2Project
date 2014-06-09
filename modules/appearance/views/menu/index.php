<?php
use Yii;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;
use yii\helpers\Url;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\appearance\searchs\MenuSearc $searchModel
 */

$this->title = Yii::t('app', 'Taxonomies');
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile(Yii::getAlias('@web').'/jnestable/nestable.css');
$this->registerJs(
        "$('ul.navigation > li.mm-dropdown > ul > li#menu').addClass('active').parent().parent().addClass('active open');"
        , View::POS_READY);

$this->registerJs(
       '$("#select-term-menu").select2({ allowClear: true, placeholder: "Menu"});'.
       '$("#select-term-position").select2({ allowClear: true, placeholder: "position"});'
        , View::POS_READY);

//delete Menu Term
$this->registerJs(        
        '$("#menu-delete-btn").on("click",function(){'
        . 'var data_id = $(this).attr("data-id");'        
        . '$("#menu-panel-item").remove();'
        . '$.ajax({
                url: "' . Url::toRoute(['/appearance/menu/deletemenuterm', 'action' => 'appearance-menu-deleteterm']) . '",                              
                type:"post",
                data:{
                    "dataid":data_id,
                    "' . Yii::$app->request->csrfParam . '" : "' . Yii::$app->request->getCsrfToken() . '"
                },
                dataType:"json",
                success:function(response){
                    if(response.status == true){
                                                
                    }else{
                    }
                }
            });'
            . 'return false;'
        . '});'
, View::POS_READY);

//delte menu item
$this->registerJs(
       '$("body").on("click",".menu-delete",function(){'
        . 'var data_id = $(this).attr("data-id");'        
        . '$(this).parent().parent().parent().remove();'
        . '$.ajax({
                url: "' . Url::toRoute(['/appearance/menu/deletemenuitem', 'action' => 'appearance-menu-deleteitem']) . '",                              
                type:"post",
                data:{
                    "dataid":data_id,
                    "' . Yii::$app->request->csrfParam . '" : "' . Yii::$app->request->getCsrfToken() . '"
                },
                dataType:"json",
                success:function(response){
                    if(response.status == true){
                         location.reload();                         
                    }else{
                    }
                }
            });'
            . 'return false;'
        . '});'
        , View::POS_READY);

//add Page to menu
$this->registerJs(
        '$("#form-page").on("submit",function(){'
        . 'var url = $(this).attr("action");'        
        . '$.ajax({
                url: url,               
                data: $(this).serialize(),
                type:"post",
                dataType:"json",
                success:function(response){
                    if(response.status == true){
                         location.reload();
                    }else{
                    }
                }
            });'
            . 'return false;'
        . '});'
        , View::POS_READY);

//add category to menu
$this->registerJs(
        '$("#form-category").on("submit",function(){'
        . 'var url = $(this).attr("action");'        
        . '$.ajax({
                url: url,               
                data: $(this).serialize(),
                type:"post",
                dataType:"json",
                success:function(response){
                    if(response.status == true){
                         location.reload();
                    }else{
                    }
                }
            });'
            . 'return false;'
        . '});'
        , View::POS_READY);

//add link to menu
$this->registerJs(
        '$("#form-link").on("submit",function(){'
        . 'var url = $(this).attr("action");'        
        . '$.ajax({
                url: url,               
                data: $(this).serialize(),
                type:"post",              
                dataType:"json",
                success:function(response){
                    if(response.status == true){
                         location.reload();
                    }else{
                    }
                }
            });'
            . 'return false;'
        . '});'
        , View::POS_READY);

//edit position menu
$this->registerJs(
        'var menu_updatesort = function(jsonstring) {
             $.ajax({
                    url: "' . Url::toRoute(['/appearance/menu/updateposition', 'action' => 'appearance-menu-updateposition']) . '",
                    type: "POST",
                    dataType: "json",
                    data: {
                        data: jsonstring,
                        "' . Yii::$app->request->csrfParam . '" : "' . Yii::$app->request->getCsrfToken() . '",
                    },
                    success: function(response) {
//                       $("html,body").animate({ scrollTop: 0 }, 500);
//                        PixelAdmin.plugins.alerts.add("<strong>Sukses!</strong>&nbsp;" + response.text, {
//                            type:"success",
//                            auto_close:9
//                       });
                    }
            });
        };
        var updateOutput = function(e)
        {
            var listdata = $("#nestable .dd-list").find("li");
            for(var i = 0; i < listdata.length; i++){
                $(listdata[i]).attr("data-position",i);
            }
        };

        var menuBuilder = function() {
            $("#nestable").nestable({group: 1}).on("change", updateOutput);      
            $(".dd-handle a").on("mousedown", function(e){
                    e.stopPropagation();
            });
        };
        menuBuilder();
        $("body").on("click",".menu-edit-btn",function(){
            var e = $("#nestable").data("output", $("#nestableMenu-output"));
            var list = e.length ? e : $(e.target);
            menu_updatesort(window.JSON.stringify(list.nestable("serialize")));
        });
        '
        , View::POS_READY);

//for menu on off
$this->registerJs(
        'init.push(function () { '
        . '$("#menu-status").switcher({'
        . 'theme: "square",'
        . '});'
        . '});'
        , View::POS_READY);

?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?php echo Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?php echo Url::toRoute(['/dashboard/dashboard/index','action'=>'dashboard']); ?>"><?php echo Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?= Url::toRoute(['/appearance/menu/index', 'action' => 'appearance-menu-list']); ?>"><?= Yii::t('app', Html::encode('Menu')); ?></a>
    </li>   
    <?php if($model->id != null): ?>
    <li class="active">
        <?= $model->name ?>
    </li> 
    <?php endif; ?>
</ul>


<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa  fa-sitemap page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Menu') ?>  
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass}', [
                    'modelClass' => 'Menu',
                ]), Url::toRoute(['/appearance/menu/create', 'action' => 'appearance-menu-create']))
                ?>
            </h1>
        </div>
        
    </div>
</div>

<!--<div class="space-10"></div>-->
<div class="row">
    <div class="col-sm-12" >
        <div class="panel">  
            
            <div class="panel-body">                
                   <?= Html::beginForm(['/appearance/menu/index', 'action' => 'appearance-menu-list'], 'get', ['class'=>'form-inline']) ?>
                    <div class="form-group">
                        <label>Pilih menu untuk di perbaharui :</label>                       
                            <?= Html::activedropDownList($model, 'id', $termmenu, ['name'=>'id','id'=>'select-term-menu','class' => 'form-control']) ?>
                    </div>
                    <div class="form-group">
                        <?= Html::button('<i class="fa   fa-check"></i> &nbsp; Select', ['class'=>'btn btn-success']) ?>                        
                    </div>
                    <?= Html::endForm()?>            
            </div>
        </div>
    </div>
</div>

<div class="row">   
    <div class="col-sm-4">
         <div class="panel colourable">
             <?php ActiveForm::begin(['id'=>'form-page','action' => ['/appearance/menu/addpagetomenu', 'action' => 'appearance-menu-pagetomenu']]); ?>
            <div class="panel-heading">
                <span class="panel-title">Halaman</span>
            </div>
            <div class="panel-body">
                <?= Html::activeHiddenInput($model, 'id') ?>     
                <?= Html::checkboxList('Page[]', null, $model->dataPageStore(), [])?>
            </div>
              <div class="panel-footer">               
                <?= Html::button("<i class='fa fa-plus'></i>&nbsp; Tambahkan ke menu", ['id'=>'cat-btn-to-menu','class'=>'btn btn-primary btn-xs'])?>               
            </div>
              <?php ActiveForm::end(); ?>
        </div>
        
        <div class="panel colourable">
            <?php ActiveForm::begin(['id'=>'form-category','action' => ['/appearance/menu/addcattomenu', 'action' => 'appearance-menu-cattomenu']]); ?>
            <div class="panel-heading">
                <span class="panel-title">Kategori</span>
            </div>
            <div class="panel-body">
                <?= Html::activeHiddenInput($model, 'id') ?>                
                <?= Html::checkboxList('Category[]', null, $model->dataCategoryTreeStore(), [])?>
            </div>
            <div class="panel-footer">               
                <?= Html::button("<i class='fa fa-plus'></i>&nbsp; Tambahkan ke menu", ['id'=>'cat-btn-to-menu','class'=>'btn btn-primary btn-xs'])?>               
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        
        <div class="panel colourable">
            <?php $formlink = ActiveForm::begin(['id'=>'form-link','action' => ['/appearance/menu/addlinktomenu', 'action' => 'appearance-menu-linktomenu']]); ?>
            <div class="panel-heading">
                <span class="panel-title">Tautan</span>
            </div>
            <div class="panel-body">
                <?= Html::activeHiddenInput($model, 'id') ?>
                <div class="form-group field-menumodel-slug">
                    <label class="control-label" for="menumodel-slug">Tautan</label>
                <?= Html::activeTextInput($model, "slug", ['value'=>"http://",'placeholder'=>'http://','class'=>'form-control','id'=>'menumodel-slug']) ?>
                </div>
                <div class="form-group field-menumodel-name required">
                    <label class="control-label" for="menumodel-name">Text Tautan</label>
                        <?= Html::activeTextInput($model, "name", ['value'=>"",'placeholder'=>'Name','class'=>'form-control','id'=>'menumodel-name']) ?>
                    <p class="help-block"></p>
                </div>                
            </div>
            <div class="panel-footer">               
                <?= Html::button("<i class='fa fa-plus'></i>&nbsp; Tambahkan ke menu", ['id'=>'cat-btn-to-menu','class'=>'btn btn-primary btn-xs'])?>               
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        
        

    </div>
    <div class="col-sm-8">
        <div class="panel" id="menu-panel-item">  
            <?php $form = ActiveForm::begin(['id'=>'form-menu-update','action' => ['/appearance/menu/update', 'action' => 'appearance-menu-update', 'id' => $model->id]]); ?>
            <?php if ($model->id != null): ?>
                <div class="panel-heading">
                    <span class="panel-title"><?= $model->name ?></span>                 
                    <div class="panel-heading-controls">                     
                        <button id="menu-edit-btn" type="submit" class="menu-edit-btn btn btn-primary btn-xs" data-id="<?= $model->id ?>"><i class="fa fa-check"></i>&nbsp; Simpan</button>
                    </div>                
                </div>
            <?php endif; ?>

            <div class="panel-body">  
                <?php if ($model->id != null): ?>
                    <?= $form->field($model, 'name')->textInput()->label('Nama Menu') ?>
                    <?= 
                        $form->field($model, 'term_id')->dropDownList([
                        18 => 'Menu Pertama (Header)',
                        19 => 'Menu Kedua (Footer)',                       
                        ],['id'=>'select-term-position'])->label('Posisi Menu')                        
                    ?>
                     
                    <div class="form-group">     
                        <label class="control-label">Status</label>
                        <div class="checkbox-inline">
                                <?= Html::activeCheckbox($model, 'status', ['value' => 'Publish', 'id' => 'menu-status']) ?>                     </div>
                        </div>
                    <div class="form-group">                     
                        <label class="control-label">Item Menu</label>
                    <?php endif; ?>
                    <div class="dd" id="nestable" style="width: 60%">
                        <?=
                        $taxmenu != null ? $model->dataMenuTreeStore($taxmenu) : "<blockquote style='margin-top: 0px; margin-bottom: 0px;  font-size:12px'>Pilih menu yang akan di perbaharui</blockquote>";
                        ?>
                        <?php if ($model->id != null): ?>  
                        <?= $menuitemlength == null ? "<div class='space-6'></div><blockquote style='margin-top: 0px; margin-bottom: 0px; font-size:12px'>Tahmbahkan item menu dari (halaman, tautan dan kategori)</blockquote>" : "" ?>                            
                        <?php endif; ?>
                    </div>
                    <?php if ($model->id != null): ?>   
                    </div>                
                    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'style' => 'resize: none;'])->label('Keterangan') ?>
                <?php endif; ?>
            </div>   
            <?php if ($model->id != null): ?>
                <div class="panel-footer">  
                    <button id="menu-delete-btn" type="button" class="btn btn-danger btn-xs" data-id="<?= $model->id ?>"><i class="fa fa-trash-o"></i>&nbsp; Hapus</button>
                    <div class="panel-heading-controls">                     
                        <button id="menu-edit-btn" type="submit" class="menu-edit-btn btn btn-primary btn-xs" data-id="<?= $model->id ?>"><i class="fa fa-check"></i>&nbsp; Simpan</button>
                    </div>
                </div>
            <?php endif; ?>
            <?php ActiveForm::end(); ?>
        </div> 
    </div>
</div>


