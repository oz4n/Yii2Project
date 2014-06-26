<div class="row about-me margin-bottom-20">
    <div class="col-md-3 shadow-wrapper md-margin-bottom-20">
        <?php
        if ($model->front_photo != null) {
            echo \yii\helpers\Html::img(Yii::getAlias('@web') . '/resources/images/member/frontphoto/' . $model->front_photo, ['id' => 'avatar', 'class' => 'editable img-responsive', 'style' => 'width:1024px', 'alt' => $model->name]);
        } else {
            echo \yii\helpers\Html::img(Yii::getAlias('@web') . '/resources/images/default/user200x200.png' . $model->front_photo, ['id' => 'avatar', 'class' => 'editable img-responsive', 'style' => 'width:1024px', 'alt' => $model->name]);
        }
        ?>
    </div>
    <div class="col-md-9">
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th style="width: 20px">NRA</th>
                        <th>:</th>
                        <td><?= $model->nra ?></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>:</td>
                        <td><?= $model->name ?></td>
                    </tr>
                    <tr>
                        <th>Satuan</th>
                        <td>:</td>
                        <td><?= $model->educational_status ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>:</td>
                        <td><?= $model->address ?></td>
                    </tr>
                </tbody>
            </table>
        </div> 
    </div>
</div>  