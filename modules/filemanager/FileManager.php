<?php

namespace app\modules\filemanager;

use yii\base\Module;

//define("FILE_TYPE_IMAGE", "image");
define("FILE_TYPE_DOCUMENT", "document");
define("FILE_TYPE_VIDEO", "video");



define("FILE_IMAGE_CAT_PPI", 1);
define("FILE_IMAGE_CAT_PASKIBRA", 1);
define("FILE_IMAGE_CAT_CAPAS", 1);

define("FILE_IMAGE_CAT_GALERY", 1);

class FileManager extends Module
{

    const FILE_IMAGE_TERM = 15;
    const FILE_VIDEO_TERM = 15;
    const FILE_DOCUMENT_TERM = 15;
    const FILE_TYPE_IMAGE = 'image';
    const FILE_TYPE_DOCUMENT = 'document';
    const FILE_TYPE_VIDEO = 'video';
    const FILE_IMAGE_CAT_PPI = 1;

    public $controllerNamespace = 'app\modules\filemanager\controllers';

    public function init()
    {
        $this->setLayoutPath('@app/modules/dashboard/views/layouts');
        $this->layout = 'main';
        parent::init();

        // custom initialization code goes here
    }

}
