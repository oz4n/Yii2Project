<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/16/14
 * Time: 11:24 PM
 */

namespace app\modules\filemanager\librarys;

use PHPThumb\GD;

class Image
{
    public function adaptiveResize($fromimg, $toimg, $w, $h)
    {
        $gd = new GD($fromimg);
        $gd->adaptiveResize($w, $h);
        $gd->save($toimg);
    }

    public function resize($fromimg, $toimg, $s)
    {
        $gd = new GD($fromimg);
        $gd->resize($s);
        $gd->save($toimg);
    }
} 