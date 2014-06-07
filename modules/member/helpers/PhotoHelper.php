<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\member\helpers;
use Yii;
use yii\imagine\Image;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Description of PhotoHelper
 *
 * @author melengo
 */
class PhotoHelper
{

    public $path;
    public $original;
    public $certificate;
    public $identitycard;
    public $frontphoto;
    public $sidephoto;
    public $system;

    public function __construct()
    {
        $this->path = Yii::$app->getBasePath() . DS . 'web' . DS . 'resources' . DS . 'images' . DS;
        $this->original = $this->path . 'original' . DS;
        $this->frontphoto = $this->path . 'member' . DS . 'frontphoto' . DS;
        $this->sidephoto = $this->path . 'member' . DS . 'sidephoto' . DS;
        $this->certificate = $this->path . 'member' . DS . 'certificate' . DS;
        $this->identitycard = $this->path . 'member' . DS . 'identitycard' . DS;
        $this->system = new Filesystem;       
    }

    public function copyProntPhoto($name)
    {
        if (null != $name) {
            return Image::thumbnail($this->original . $name, 611, 850)
                            ->save($this->frontphoto . $name, ['quality' => 80]);
        }
    }

    public function copyProntPhotoThumb($name)
    {
        if (null != $name) {
            return Image::thumbnail($this->original . $name, 42, 42)
                            ->save($this->frontphoto . '42x42' . DS . $name, ['quality' => 100]);
        }
    }

    public function copySidePhoto($name)
    {
        if (null != $name) {
            return Image::thumbnail($this->original . $name, 611, 850)
                            ->save($this->sidephoto . $name, ['quality' => 80]);
        }
    }

    public function copyCertificatePhoto($name)
    {
        if (null != $name) {
            return $this->system->copy($this->original . $name, $this->certificate . $name);
        }
    }

    public function copyIdentityCardPhoto($name)
    {
        if (null != $name) {
            return $this->system->copy($this->original . $name, $this->identitycard . $name);
        }
    }

    public function deleteProntPhoto($name)
    {
        if (null != $name) {
            return $this->system->remove($this->frontphoto . $name);
        }
    }

    public function deleteProntPhotoThumb($name)
    {
        if (null != $name) {
            return $this->system->remove($this->frontphoto .'42x42' . DS . $name);
        }
    }

    public function deleteSidePhoto($name)
    {
        if (null != $name) {
            return $this->system->remove($this->sidephoto . $name);
        }
    }

    public function deleteCertificatePhoto($name)
    {
        if (null != $name) {
            return $this->system->remove($this->certificate . $name);
        }
    }

    public function deleteIdentityCardPhoto($name)
    {
        if (null != $name) {
            return $this->system->remove($this->identitycard . $name);
        }
    }

}
