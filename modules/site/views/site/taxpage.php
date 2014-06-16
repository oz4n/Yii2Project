<?php
$this->title =$tax;
$this->registerMetaTag(['name' => 'keywords', 'content' => $tax]);
switch ($model->layout) {
    case "full":
        echo $this->render('_taxpage_full_view', [
            'model' => $model,
            'tax' => $tax,
            'other' => $other
        ]);
        break;
    case 'left':
        echo $this->render('_taxpage_left_view', [
            'model' => $model,
            'tax' => $tax,
            'other' => $other
        ]);
        break;
    case 'right':
        echo $this->render('_taxpage_right_view', [
            'model' => $model,
            'tax' => $tax,
            'other' => $other
        ]);
        break;
}
