<div class="row about-me margin-bottom-20">
    <div class="col-md-3 shadow-wrapper md-margin-bottom-20">
        <div class="thumbnail thumbnails thumbnail-style thumbnail-kenburn">
            <div class="thumbnail-img">
                <div class="overflow-hidden">
                    <img style="width: 1024px" class="img-responsive" src="<?php echo Yii::getAlias('@web').'/resources/images/member/frontphoto/'.$model->front_photo; ?>" alt="">  
                </div>
            </div>  
        </div>
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
                        <td>CSS</td>
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