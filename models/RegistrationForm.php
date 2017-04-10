<?php

namespace app\models;

//use dektrium\user\models\Profile;
use dektrium\user\models\RegistrationForm as BaseRegistrationForm;
use app\models\User;


use Yii;

class RegistrationForm extends BaseRegistrationForm
{
    /**
     * Add a new field
     * @var string
     */
    public $fullname;
    /*   add  column  */
    public $hoscode; 

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['username', 'required'];
        $rules[] = ['username', 'string', 'min' => 5,'max' => 25];
        $rules[] = ['fullname', 'required'];
        $rules[] = ['hoscode', 'required'];
        $rules[] = ['hoscode', 'string', 'min' => 5,'max' => 5];
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['fullname'] = \Yii::t('user', 'ชื่อ-สกุล');
        $labels['hoscode'] = \Yii::t('user', 'หน่วยบริการ');
        return $labels;
    }

    /**
     * @inheritdoc
     */
    public function loadAttributes(User $user)
    {
        // here is the magic happens
        $user->setAttributes([
            'email'    => $this->email,
            'username' => $this->username,
            'password' => $this->password,
        ]);
        /** @var Profile $profile */
        $profile = \Yii::createObject(Profile::className());
        $profile->setAttributes([
            'fullname' => $this->fullname,
            'hoscode'=>$this->hoscode,
        ]);
        $user->setProfile($profile);
    }
    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        /** @var User $user */
        $user = Yii::createObject(User::className());
        $user->setScenario('register');
        $this->loadAttributes($user);

        if (!$user->register()) {
            return false;
        }

        Yii::$app->session->setFlash(
            'success',
            Yii::t(
                'user',
                'คุณได้ลงทะเบียนเรียบร้อยแล้ว  กรุณาติดต่อ admin เพื่อจัดการสิทธิ'
            )
        );

        return true;
    }
}