
<time class="cbp_tmtime" datetime="">
    <span><?= date('m/d/Y', strtotime($model->create_et)) ?></span> <span><?= date('F', strtotime($model->create_et)) ?></span>
</time>

<?=
\cebe\gravatar\Gravatar::widget([
    'email' => $model->email,
    'size' => 45,
    'defaultImage' => 'mm',
    'options' => [
        'alt' => $model->name,
        'class' => 'rounded-x hidden-xs'
    ]
])
?>
<div class="cbp_tmlabel">

    <h2><?= $model->subject ?><small class="pull-right"><?= \yii\helpers\Html::a('<i class="fa fa-mail-reply"></i>Jawab', ['/site/guestbook/reply', 'id' => $model->id]) ?></small></h2>

    <p><?= $model->content ?></p>
    <blockquote>
        <small>@<?= $model->name ?></small>
    </blockquote>   
    <?php foreach ($model->getAllMassageByParent($model->id) as $value): ?>
        <div class="media">
            <div class="pull-left">
                <?=
                \cebe\gravatar\Gravatar::widget([
                    'email' => $value->email,
                    'size' => 32,
                    'defaultImage' => 'mm',
                    'options' => [
                        'alt' => $value->name,
                        'class' => 'rounded-x hidden-xs'
                    ]
                ])
                ?>
            </div>
            <div class="media-body">                
                <p>@<?= $value->name ?>&nbsp;|&nbsp;<?= $value->content; ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

