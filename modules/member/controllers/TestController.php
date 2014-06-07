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

//        $ppiindex = $auth->createPermission('ppiindex');
//        $ppiindex->description = 'List data anggota ppi';
//        $auth->add($ppiindex);
//
//        $ppiview = $auth->createPermission('ppiview');
//        $ppiview->description = 'Lihat detail data anggota ppi';
//        $auth->add($ppiview);
//
//        $ppicreate = $auth->createPermission('ppicreate');
//        $ppicreate->description = 'Tambah data anggota ppi';
//        $auth->add($ppicreate);
//
//        $ppiupdate = $auth->createPermission('ppiupdate');
//        $ppiupdate->description = 'Perbaharui data anggota ppi';
//        $auth->add($ppiupdate);
//
//        $ppitrash = $auth->createPermission('ppitrash');
//        $ppitrash->description = 'Buang ketongsampah data anggota ppi';
//        $auth->add($ppitrash);
//
//        $ppidelete = $auth->createPermission('ppidelete');
//        $ppidelete->description = 'Hapus data anggota ppi';
//        $auth->add($ppidelete);
//
//        $auth->addChild($auth->getRole('subadminppe'), $ppiindex);
//        $auth->addChild($auth->getRole('subadminppe'), $ppiview);
//        $auth->addChild($auth->getRole('subadminppe'), $ppicreate);
//        $auth->addChild($auth->getRole('subadminppe'), $ppiupdate);
//        $auth->addChild($auth->getRole('subadminppe'), $ppitrash);
//        $auth->addChild($auth->getRole('subadminppe'), $ppidelete);

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

//        $capasindex = $auth->createPermission('capasindex');
//        $capasindex->description = 'List data anggota capas';
//        $auth->add($capasindex);
//
//        $capasview = $auth->createPermission('capasview');
//        $capasview->description = 'Lihat detail data anggota capas';
//        $auth->add($capasview);
//
//        $capascreate = $auth->createPermission('capascreate');
//        $capascreate->description = 'Tambah data anggota capas';
//        $auth->add($capascreate);
//
//        $capasupdate = $auth->createPermission('capasupdate');
//        $capasupdate->description = 'Perbaharui data anggota capas';
//        $auth->add($capasupdate);
//
//        $capastrash = $auth->createPermission('capastrash');
//        $capastrash->description = 'Buang ketongsampah data anggota capas';
//        $auth->add($capastrash);
//
//        $capasdelete = $auth->createPermission('capasdelete');
//        $capasdelete->description = 'Hapus data anggota capas';
//        $auth->add($capasdelete);
//        $auth->addChild($auth->getRole('subadminppe'), $capasindex);
//        $auth->addChild($auth->getRole('subadminppe'), $capasview);
//        $auth->addChild($auth->getRole('subadminppe'), $capascreate);
//        $auth->addChild($auth->getRole('subadminppe'), $capasupdate);
//        $auth->addChild($auth->getRole('subadminppe'), $capastrash);
//        $auth->addChild($auth->getRole('subadminppe'), $capasdelete);

//        $brevetawardindex = $auth->createPermission('brevetawardindex');
//        $brevetawardindex->description = 'List data brevet peghargaan';
//        $auth->add($brevetawardindex);
//
//        $brevetawardview = $auth->createPermission('brevetawardview');
//        $brevetawardview->description = 'Lihat detail data brevet peghargaan';
//        $auth->add($brevetawardview);
//
//        $brevetawardcreate = $auth->createPermission('brevetawardcreate');
//        $brevetawardcreate->description = 'Tambah data brevet peghargaan';
//        $auth->add($brevetawardcreate);
//
//        $brevetawardupdate = $auth->createPermission('brevetawardupdate');
//        $brevetawardupdate->description = 'Perbaharui data brevet peghargaan';
//        $auth->add($brevetawardupdate);
//
//        $brevetawardbulk = $auth->createPermission('brevetawardbulk');
//        $brevetawardbulk->description = 'Hapus data brevet peghargaan secara masal';
//        $auth->add($brevetawardbulk);
//
//        $brevetawarddelete = $auth->createPermission('brevetawarddelete');
//        $brevetawarddelete->description = 'Hapus data brevet peghargaan';
//        $auth->add($brevetawarddelete);
//
//        $auth->addChild($auth->getRole('subadminppe'), $brevetawardindex);
//        $auth->addChild($auth->getRole('subadminppe'), $brevetawardview);
//        $auth->addChild($auth->getRole('subadminppe'), $brevetawardcreate);
//        $auth->addChild($auth->getRole('subadminppe'), $brevetawardupdate);
//        $auth->addChild($auth->getRole('subadminppe'), $brevetawardbulk);
//        $auth->addChild($auth->getRole('subadminppe'), $brevetawarddelete);

//        $lifeskillindex = $auth->createPermission('lifeskillindex');
//        $lifeskillindex->description = 'List data keterampilan';
//        $auth->add($lifeskillindex);
//
//        $lifeskillview = $auth->createPermission('lifeskillview');
//        $lifeskillview->description = 'Lihat detail data keterampilan';
//        $auth->add($lifeskillview);
//
//        $lifeskillcreate = $auth->createPermission('lifeskillcreate');
//        $lifeskillcreate->description = 'Tambah data keterampilan';
//        $auth->add($lifeskillcreate);
//
//        $lifeskillupdate = $auth->createPermission('lifeskillupdate');
//        $lifeskillupdate->description = 'Perbaharui data keterampilan';
//        $auth->add($lifeskillupdate);
//
//        $lifeskillbulk = $auth->createPermission('lifeskillbulk');
//        $lifeskillbulk->description = 'Hapus data keterampilan secara masal';
//        $auth->add($lifeskillbulk);
//
//        $lifeskilldelete = $auth->createPermission('lifeskilldelete');
//        $lifeskilldelete->description = 'Hapus data keterampilan';
//        $auth->add($lifeskilldelete);
//
//        $auth->addChild($auth->getRole('subadminppe'), $lifeskillindex);
//        $auth->addChild($auth->getRole('subadminppe'), $lifeskillview);
//        $auth->addChild($auth->getRole('subadminppe'), $lifeskillcreate);
//        $auth->addChild($auth->getRole('subadminppe'), $lifeskillupdate);
//        $auth->addChild($auth->getRole('subadminppe'), $lifeskillbulk);
//        $auth->addChild($auth->getRole('subadminppe'), $lifeskilldelete);

//        $languageskillindex = $auth->createPermission('languageskillindex');
//        $languageskillindex->description = 'List data keterampilan bahasa';
//        $auth->add($languageskillindex);
//
//        $languageskillview = $auth->createPermission('languageskillview');
//        $languageskillview->description = 'Lihat detail data keterampilan bahasa';
//        $auth->add($languageskillview);
//
//        $languageskillcreate = $auth->createPermission('languageskillcreate');
//        $languageskillcreate->description = 'Tambah data keterampilan bahasa';
//        $auth->add($languageskillcreate);
//
//        $languageskillupdate = $auth->createPermission('languageskillupdate');
//        $languageskillupdate->description = 'Perbaharui data keterampilan bahasa';
//        $auth->add($languageskillupdate);
//
//        $languageskillbulk = $auth->createPermission('languageskillbulk');
//        $languageskillbulk->description = 'Hapus data keterampilan bahasa secara masal';
//        $auth->add($languageskillbulk);
//
//        $languageskilldelete = $auth->createPermission('languageskilldelete');
//        $languageskilldelete->description = 'Hapus data keterampilan bahasa';
//        $auth->add($languageskilldelete);
//
//        $auth->addChild($auth->getRole('subadminppe'), $languageskillindex);
//        $auth->addChild($auth->getRole('subadminppe'), $languageskillview);
//        $auth->addChild($auth->getRole('subadminppe'), $languageskillcreate);
//        $auth->addChild($auth->getRole('subadminppe'), $languageskillupdate);
//        $auth->addChild($auth->getRole('subadminppe'), $languageskillbulk);
//        $auth->addChild($auth->getRole('subadminppe'), $languageskilldelete);

//        $areaindex = $auth->createPermission('areaindex');
//        $areaindex->description = 'List data daerah';
//        $auth->add($areaindex);
//
//        $areaview = $auth->createPermission('areaview');
//        $areaview->description = 'Lihat detail data daerah';
//        $auth->add($areaview);
//
//        $areacreate = $auth->createPermission('areacreate');
//        $areacreate->description = 'Tambah data daerah';
//        $auth->add($areacreate);
//
//        $areaupdate = $auth->createPermission('areaupdate');
//        $areaupdate->description = 'Perbaharui data daerah';
//        $auth->add($areaupdate);
//
//        $areabulk = $auth->createPermission('areabulk');
//        $areabulk->description = 'Hapus data daerah secara masal';
//        $auth->add($areabulk);
//
//        $areadelete = $auth->createPermission('areadelete');
//        $areadelete->description = 'Hapus data daerah';
//        $auth->add($areadelete);
//
//        $auth->addChild($auth->getRole('subadminppe'), $areaindex);
//        $auth->addChild($auth->getRole('subadminppe'), $areaview);
//        $auth->addChild($auth->getRole('subadminppe'), $areacreate);
//        $auth->addChild($auth->getRole('subadminppe'), $areaupdate);
//        $auth->addChild($auth->getRole('subadminppe'), $areabulk);
//        $auth->addChild($auth->getRole('subadminppe'), $areadelete);

//        $tribeindex = $auth->createPermission('tribeindex');
//        $tribeindex->description = 'List data suku bangsa';
//        $auth->add($tribeindex);
//
//        $tribeview = $auth->createPermission('tribeview');
//        $tribeview->description = 'Lihat detail data suku bangsa';
//        $auth->add($tribeview);
//
//        $tribecreate = $auth->createPermission('tribecreate');
//        $tribecreate->description = 'Tambah data suku bangsa';
//        $auth->add($tribecreate);
//
//        $tribeupdate = $auth->createPermission('tribeupdate');
//        $tribeupdate->description = 'Perbaharui data suku bangsa';
//        $auth->add($tribeupdate);
//
//        $tribebulk = $auth->createPermission('tribebulk');
//        $tribebulk->description = 'Hapus data suku bangsa secara masal';
//        $auth->add($tribebulk);
//
//        $tribedelete = $auth->createPermission('tribedelete');
//        $tribedelete->description = 'Hapus data suku bangsa';
//        $auth->add($tribedelete);
//
//        $auth->addChild($auth->getRole('subadminppe'), $tribeindex);
//        $auth->addChild($auth->getRole('subadminppe'), $tribeview);
//        $auth->addChild($auth->getRole('subadminppe'), $tribecreate);
//        $auth->addChild($auth->getRole('subadminppe'), $tribeupdate);
//        $auth->addChild($auth->getRole('subadminppe'), $tribebulk);
//        $auth->addChild($auth->getRole('subadminppe'), $tribedelete);

//        $schoolindex = $auth->createPermission('schoolindex');
//        $schoolindex->description = 'List data skolah';
//        $auth->add($schoolindex);
//
//        $schoolview = $auth->createPermission('schoolview');
//        $schoolview->description = 'Lihat detail data skolah';
//        $auth->add($schoolview);
//
//        $schoolcreate = $auth->createPermission('schoolcreate');
//        $schoolcreate->description = 'Tambah data skolah';
//        $auth->add($schoolcreate);
//
//        $schoolupdate = $auth->createPermission('schoolupdate');
//        $schoolupdate->description = 'Perbaharui data skolah';
//        $auth->add($schoolupdate);
//
//        $schoolbulk = $auth->createPermission('schoolbulk');
//        $schoolbulk->description = 'Hapus data skolah secara masal';
//        $auth->add($schoolbulk);
//
//        $schooldelete = $auth->createPermission('schooldelete');
//        $schooldelete->description = 'Hapus data skolah';
//        $auth->add($schooldelete);
//
//        $auth->addChild($auth->getRole('subadminppe'), $schoolindex);
//        $auth->addChild($auth->getRole('subadminppe'), $schoolview);
//        $auth->addChild($auth->getRole('subadminppe'), $schoolcreate);
//        $auth->addChild($auth->getRole('subadminppe'), $schoolupdate);
//        $auth->addChild($auth->getRole('subadminppe'), $schoolbulk);
//        $auth->addChild($auth->getRole('subadminppe'), $schooldelete);
    }

    public function actionAddrule()
    {
        $auth = Yii::$app->authManager;

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
