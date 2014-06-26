<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\site\models;

use app\modules\dao\ar\User;
use yii\helpers\Security;
use dektrium\user\helpers\Password;

/**
 * Description of UserModel
 *
 * @author melengo
 */
class UserModel extends User
{

  

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
                'source_attribute' => 'username',
                'slug_attribute' => 'slug',
                // optional params
                'translit' => false,
                'replacement' => '',
                'lowercase' => true,
                'unique' => true
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username rules
            ['username', 'required', 'on' => ['register', 'connect', 'create', 'update'], 'message' => 'Tidak Boleh kosong'],
            ['username', 'match', 'pattern' => '/^[a-zA-Z]\w+$/', 'message' => 'Nama akun tidak valid'],
            ['username', 'string', 'min' => 6, 'max' => 25, 'message' => 'Nama akun min 6 dan max 25 karakter'],
            ['username', 'unique', 'message' => 'Nama akun yang anda inputkan sudah di gunakan'],
            ['username', 'trim', 'message' => 'Nama akun tidak boleh mengunakan sepasi'],
            // email rules
            ['email', 'required', 'on' => ['register', 'connect', 'create', 'update', 'update_email'], 'message' => 'Tidak Boleh kosong'],
            ['email', 'email', 'message' => 'Email anda tidak valid'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'message' => 'Email yang anda inputkan sudah di gunakan'],
            ['email', 'trim'],
            // unconfirmed email rules
            ['unconfirmed_email', 'required', 'on' => 'update_email', 'message' => 'Tidak Boleh kosong'],
            ['unconfirmed_email', 'unique', 'targetAttribute' => 'email', 'on' => 'update_email'],
            ['unconfirmed_email', 'email', 'on' => 'update_email'],
            // password rules
            ['password', 'required', 'on' => ['register', 'update_password'], 'message' => 'Tidak Boleh kosong'],
            ['password', 'string', 'min' => 6, 'on' => ['register', 'update_password', 'create']],
            // current password rules
            ['current_password', 'required', 'on' => ['update_email', 'update_password']],
            ['current_password', function ($attr) {
            if (!empty($this->$attr) && !Password::validate($this->$attr, $this->password_hash)) {
                $this->addError($attr, \Yii::t('user', 'Kata sandi sebelumnya tidak valid.'));
            }
        }, 'on' => ['update_email', 'update_password']],
        ];
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->setAttribute('auth_key', Security::generateRandomKey());
            $this->setAttribute('role', $this->getRole());
            $this->setAttribute('created_at', time());
            $this->setAttribute('updated_at', time());
        }

        if (!empty($this->password)) {
            $this->setAttribute('password_hash', Password::hash($this->password));
        }

        return parent::beforeSave($insert);
    }

    public function afterSave($insert)
    {
        if ($insert) {
            $member = new MemberModel();
            $member->user_id = $this->id;
            $member->create_et = date("Y-m-d H:i:s");
            $member->update_et = date("Y-m-d H:i:s");
            $member->email = $this->email;
            $member->save_status = "Pending";
            switch ($this->role) {
                case "ppimember":
                    $member->type_member = "PPI";
                    break;
                case "capasmember":
                    $member->type_member = "Capas";
                    break;
                case "paskibramember":
                    $member->type_member = "Paskibra";
                    break;
            }
            $member->save();

            $role = new AuthAssignmentModel();
            $role->setAttribute('user_id', $this->id);
            $role->setAttribute('item_name', $this->role);
            $role->setAttribute('created_at', time());
            $role->save();
        }
        parent::afterSave($insert);
    }

}
