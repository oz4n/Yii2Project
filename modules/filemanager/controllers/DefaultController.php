<?php

namespace app\modules\filemanager\controllers;

use Yii;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $auth = Yii::$app->authManager;

//        $imageindex = $auth->createPermission('imageindex');
//        $imageindex->description = 'List data gambar';
//        $auth->add($imageindex);
//
//        $imageview = $auth->createPermission('imageview');
//        $imageview->description = 'Lihat detail data gambar';
//        $auth->add($imageview);
//
//        $imageloadredactoralbum = $auth->createPermission('imageloadredactoralbum');
//        $imageloadredactoralbum->description = 'List data album pada modal';
//        $auth->add($imageloadredactoralbum);
//
//        $imageuploadredactorimage = $auth->createPermission('imageuploadredactorimage');
//        $imageuploadredactorimage->description = 'Tambah data gambar melalui modal';
//        $auth->add($imageuploadredactorimage);
//
//        $imageloadredactorimage = $auth->createPermission('imageloadredactorimage');
//        $imageloadredactorimage->description = 'List data gambar pada modal';
//        $auth->add($imageloadredactorimage);
//
//        $imageupdate = $auth->createPermission('imageupdate');
//        $imageupdate->description = 'Perbaharui data gambar';
//        $auth->add($imageupdate);
//
//        $imageupload = $auth->createPermission('imageupload');
//        $imageupload->description = 'Tambah data gambar';
//        $auth->add($imageupload);
//
//        $imagedelete = $auth->createPermission('imagedelete');
//        $imagedelete->description = 'Hapus data gambar';
//        $auth->add($imagedelete);
//
//        $auth->addChild($auth->getRole('subadminppe'), $imageindex);
//        $auth->addChild($auth->getRole('subadminppe'), $imageview);
//        $auth->addChild($auth->getRole('subadminppe'), $imageloadredactoralbum);
//        $auth->addChild($auth->getRole('subadminppe'), $imageuploadredactorimage);
//        $auth->addChild($auth->getRole('subadminppe'), $imageloadredactorimage);
//        $auth->addChild($auth->getRole('subadminppe'), $imageupdate);
//        $auth->addChild($auth->getRole('subadminppe'), $imageupload);
//        $auth->addChild($auth->getRole('subadminppe'), $imagedelete);

//        $albumindex = $auth->createPermission('albumindex');
//        $albumindex->description = 'List data album gambar';
//        $auth->add($albumindex);
//
//        $albumview = $auth->createPermission('albumview');
//        $albumview->description = 'Lihat detail data album gambar';
//        $auth->add($albumview);
//
//        $albumcreate = $auth->createPermission('albumcreate');
//        $albumcreate->description = 'Tambah data album gambar';
//        $auth->add($albumcreate);
//
//        $albumupdate = $auth->createPermission('albumupdate');
//        $albumupdate->description = 'Perbaharui data album gambar';
//        $auth->add($albumupdate);
//
//
//        $albumdelete = $auth->createPermission('albumdelete');
//        $albumdelete->description = 'Hapus data album gambar';
//        $auth->add($albumdelete);
//
//        $auth->addChild($auth->getRole('subadminppe'), $albumindex);
//        $auth->addChild($auth->getRole('subadminppe'), $albumview);
//        $auth->addChild($auth->getRole('subadminppe'), $albumcreate);
//        $auth->addChild($auth->getRole('subadminppe'), $albumupdate);
//        $auth->addChild($auth->getRole('subadminppe'), $albumdelete);
    }
}
