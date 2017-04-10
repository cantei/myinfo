<?php

namespace app\models;

use dektrium\user\models\Profile as BaseProfile;
use app\models\Chospital;

class Profile extends BaseProfile {

    public function rules() {
        $rules = parent::rules();
        $rules[] = ['hoscode', 'required'];
        $rules[] = ['fullname', 'required'];
        return $rules;
    }

    public function attributeLabels() {
        $labels = parent::attributeLabels();
        $labels['fullname'] = \Yii::t('profile', 'ชื่อ-สกุล');
        $labels['hoscode'] = \Yii::t('profile', 'PCU');
        return $labels;
    }

    public function getChospital() {
        return @$this->hasOne(Chospital::className(), ['hoscode' => 'hospcode']);
    }

}

?>