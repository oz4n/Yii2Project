
<?php
use Yii;
/** @var app\modules\dao\ar\File $v */
foreach (\app\modules\filemanager\searchs\ImageSearc::find()->orderBy(['create_at' => SORT_DESC])->all() as $v):
    ?>
    <li>
        <div>
            <img data-thumb="<?= Yii::getAlias('@web') . "/resources/member/thumbnail/" . $v->unique_name ?>" alt="<?= $v->name ?>" src="<?= Yii::getAlias('@web') . "/resources/member/thumbnail/150x150/" . $v->unique_name ?>" data-unique-name="<?= $v->unique_name ?>" />                                            
        </div>
        <div class="tools tools-bottom"> 
            <a href="javascript:undefined;" class="select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Perbesar">
                <i class="fa fa-search-plus"></i>
            </a>
            <a href="javascript:undefined;" class="select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Hapus">
                <i class="fa fa-times" style="color:#d15b47"></i>
            </a>
            <a href="javascript:undefined;" class="select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Pilih">
                <i class="fa fa-share"></i>
            </a>
        </div>
    </li>   
<?php endforeach; ?>
                