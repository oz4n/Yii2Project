<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/11/14
 * Time: 5:01 PM
 */

namespace app\modules\member\controllers;

use Yii;
use yii\web\Controller;
use yii\web\User;

class TestController extends Controller
{

    public function actionIndex()
    {
        echo Yii::$app->user->identity->role;
//        $auth = Yii::$app->authManager;
//        $rule = new \app\modules\users\rules\PpiGroupRule();
//        $auth->add($rule);
//        
//        $ppiindex = $auth->createPermission('ppiindex');
//        $ppiindex->description = 'List data anggota ppi';
//        $ppiindex->ruleName = $rule->name;
//        $auth->add($ppiindex);
//        
//        $ppiview = $auth->createPermission('ppiview');
//        $ppiview->description = 'Lihat detail data anggota ppi';
//        $ppiview->ruleName = $rule->name;
//        $auth->add($ppiview);
//        
//        $ppicreate = $auth->createPermission('ppicreate');
//        $ppicreate->description = 'Tambah data anggota ppi';
//        $ppicreate->ruleName = $rule->name;
//        $auth->add($ppicreate);
//        
//        $ppiupdate = $auth->createPermission('ppiupdate');
//        $ppiupdate->description = 'Perbaharui data anggota ppi';
//        $ppiupdate->ruleName = $rule->name;
//        $auth->add($ppiupdate);
//        
//        $ppitrash = $auth->createPermission('ppitrash');
//        $ppitrash->description = 'Buang ketongsampah data anggota ppi';
//        $ppitrash->ruleName = $rule->name;
//        $auth->add($ppitrash);
//        
//        $ppidelete = $auth->createPermission('ppidelete');
//        $ppidelete->description = 'Hapus data anggota ppi';
//        $ppidelete->ruleName = $rule->name;
//        $auth->add($ppidelete);
//        
//        $adminppe = $auth->getRole('adminppe');        
//        $auth->addChild($adminppe, $ppiindex);
//        $auth->addChild($adminppe, $ppiview);
//        $auth->addChild($adminppe, $ppicreate);
//        $auth->addChild($adminppe, $ppiupdate);
//        $auth->addChild($adminppe, $ppitrash);
//        $auth->addChild($adminppe, $ppidelete);
//        
//        $subadminppe = $auth->getRole('subadminppe');
//        $auth->addChild($subadminppe, $ppiindex);
//        $auth->addChild($subadminppe, $ppiview);
//        $auth->addChild($subadminppe, $ppicreate);
//        $auth->addChild($subadminppe, $ppiupdate);
//        $auth->addChild($subadminppe, $ppitrash);
//        $auth->addChild($subadminppe, $ppidelete);
    }

    public function actionAddadministrator()
    {
        $auth = Yii::$app->authManager;
        $rule = new \app\modules\users\rules\UserGroupRule();
        $auth->add($rule);

        $admin = $auth->createRole('admin');
        $admin->ruleName = $rule->name;
        $admin->description = "Admin default user";
        $auth->add($admin);
        $auth->addChild($admin, $auth->getRole('adminppe'));

        $administrator = $auth->createRole('administrator');
        $administrator->ruleName = $rule->name;
        $administrator->description = "Administrator default user";
        $auth->add($administrator);
        $auth->addChild($administrator, $admin);
    }

    public function actionAddmemberrule()
    {
        $auth = Yii::$app->authManager;
//        $paskibraindex = $auth->createPermission('paskibraindex');
//        $paskibraindex->description = 'List data anggota paskibra';
//        $auth->add($paskibraindex);
//
//        $paskibraview = $auth->createPermission('paskibraview');
//        $paskibraview->description = 'Lihat detail data anggota paskibra';
//        $auth->add($paskibraview);
//
//        $paskibracreate = $auth->createPermission('paskibracreate');
//        $paskibracreate->description = 'Tambah data anggota paskibra';
//        $auth->add($paskibracreate);
//
//        $paskibraupdate = $auth->createPermission('paskibraupdate');
//        $paskibraupdate->description = 'Perbaharui data anggota paskibra';
//        $auth->add($paskibraupdate);
//
//        $paskibratrash = $auth->createPermission('paskibratrash');
//        $paskibratrash->description = 'Buang ketongsampah data anggota paskibra';
//        $auth->add($paskibratrash);
//
//        $paskibradelete = $auth->createPermission('paskibradelete');
//        $paskibradelete->description = 'Hapus data anggota paskibra';
//        $auth->add($paskibradelete);
//
//        $auth->addChild($auth->getRole('subadminppe'), $paskibraindex);
//        $auth->addChild($auth->getRole('subadminppe'), $paskibraview);
//        $auth->addChild($auth->getRole('subadminppe'), $paskibracreate);
//        $auth->addChild($auth->getRole('subadminppe'), $paskibraupdate);
//        $auth->addChild($auth->getRole('subadminppe'), $paskibratrash);
//        $auth->addChild($auth->getRole('subadminppe'), $paskibradelete);

        $capasindex = $auth->createPermission('capasindex');
        $capasindex->description = 'List data anggota capas';
        $auth->add($capasindex);

        $capasview = $auth->createPermission('capasview');
        $capasview->description = 'Lihat detail data anggota capas';
        $auth->add($capasview);

        $capascreate = $auth->createPermission('capascreate');
        $capascreate->description = 'Tambah data anggota capas';
        $auth->add($capascreate);

        $capasupdate = $auth->createPermission('capasupdate');
        $capasupdate->description = 'Perbaharui data anggota capas';
        $auth->add($capasupdate);

        $capastrash = $auth->createPermission('capastrash');
        $capastrash->description = 'Buang ketongsampah data anggota capas';
        $auth->add($capastrash);

        $capasdelete = $auth->createPermission('capasdelete');
        $capasdelete->description = 'Hapus data anggota capas';
        $auth->add($capasdelete);

        $auth->addChild($auth->getRole('subadminppe'), $capasindex);
        $auth->addChild($auth->getRole('subadminppe'), $capasview);
        $auth->addChild($auth->getRole('subadminppe'), $capascreate);
        $auth->addChild($auth->getRole('subadminppe'), $capasupdate);
        $auth->addChild($auth->getRole('subadminppe'), $capastrash);
        $auth->addChild($auth->getRole('subadminppe'), $capasdelete);
    }

    public function actionAddrule()
    {
        $auth = Yii::$app->authManager;

        $ppiindex = $auth->createPermission('ppiindex');
        $ppiindex->description = 'List data anggota ppi';
        $auth->add($ppiindex);

        $ppiview = $auth->createPermission('ppiview');
        $ppiview->description = 'Lihat detail data anggota ppi';
        $auth->add($ppiview);

        $ppicreate = $auth->createPermission('ppicreate');
        $ppicreate->description = 'Tambah data anggota ppi';
        $auth->add($ppicreate);

        $ppiupdate = $auth->createPermission('ppiupdate');
        $ppiupdate->description = 'Perbaharui data anggota ppi';
        $auth->add($ppiupdate);

        $ppitrash = $auth->createPermission('ppitrash');
        $ppitrash->description = 'Buang ketongsampah data anggota ppi';
        $auth->add($ppitrash);

        $ppidelete = $auth->createPermission('ppidelete');
        $ppidelete->description = 'Hapus data anggota ppi';
        $auth->add($ppidelete);

        $subadminppe = $auth->createRole('subadminppe');
        $subadminppe->description = 'Sub Admin PPE';

        $auth->add($subadminppe);
        $auth->addChild($subadminppe, $ppiindex);
        $auth->addChild($subadminppe, $ppiview);
        $auth->addChild($subadminppe, $ppicreate);
        $auth->addChild($subadminppe, $ppiupdate);
        $auth->addChild($subadminppe, $ppitrash);
        $auth->addChild($subadminppe, $ppidelete);


        $adminppe = $auth->createRole('adminppe');
        $adminppe->description = 'Admin PPE';
        $auth->add($adminppe);
        $auth->addChild($adminppe, $ppiupdate);
        $auth->addChild($adminppe, $subadminppe);

        $auth->assign($adminppe, 2);
        $auth->assign($subadminppe, 3);
    }

}
