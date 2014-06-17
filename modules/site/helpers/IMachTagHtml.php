<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\site\helpers;

/**
 * Description of IGetImg
 *
 * @author melengo
 */
class IMachTagHtml
{

    public static function getImgMach($content, $imgdefault, $mach = array())
    {
        preg_match('/<img .*?(?=src)src=\"([^\"]+)\"/si', $content, $mach);
        if ($mach != null) {
            return $mach[1];
        } else {
            return $imgdefault;
        }
    }

    public static function getImgMachAll($content, $imgdefault, $mach = array())
    {
        preg_match_all('/<img .*?(?=src)src=\"([^\"]+)\"/si', $content, $mach);
        if ($mach != null) {
            return $mach[1];
        } else {
            return $imgdefault;
        }
    }

    public static function getImgFileUidMach($content, $mach = array())
    {
        preg_match('/<img .*?(?=file-uid)file-uid=\"([^\"]+)\"/si', $content, $mach);
        if ($mach != null) {
            return $mach[1];
        } else {
            return false;
        }
    }

    public static function getImgFileUidMachAll($content, $mach = array())
    {
        preg_match_all('/<img .*?(?=file-uid)file-uid=\"([^\"]+)\"/si', $content, $mach);
        if ($mach != null) {
            return $mach[1];
        } else {
            return false;
        }
    }

    public static function getUrlMach($text)
    {
        preg_match('%^((https?://)|(www\.))([a-z0-9-].?)+(:[0-9]+)?(/.*)?$%i', $text, $matches);
        return $matches;
    }

}
