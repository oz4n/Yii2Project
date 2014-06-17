
<time class="cbp_tmtime" datetime="">
    <span><?= date('m/d/Y', strtotime($model->create_et)) ?></span> <span><?= date('F', strtotime($model->create_et)) ?></span>
</time>

<?=
\cebe\gravatar\Gravatar::widget([
    'email' => $model->email,
     'size' => 45,
    'defaultImage' =>'mm',
    'options' => [
        'alt' => $model->name,
        'class' => 'rounded-x hidden-xs'
    ]
])
?>
<div class="cbp_tmlabel">

    <h2><?= $model->subject ?></h2>
    <blockquote>
        <p><?= $model->content ?></p>
        <small>@<?= $model->name ?></small>
    </blockquote>
</div>
