<?php

namespace app\models;

use dektrium\user\models\User as BaseUser;
use app\models\AuthAssignment;
use yii\helpers\ArrayHelper;

class User extends BaseUser {


    
    public function rules() {
        $rules = parent::rules();
        $rules[] = ['confirmed_at', 'safe'];       
        return $rules;
    }

    public function attributeLabels() {
        $labels = parent::attributeLabels();
        $labels['confirmed_at'] = \Yii::t('user', 'confirmed');
        return $labels;
    }
    
    public function getAuthAssignment() {
        return @$this->hasOne(AuthAssignment::className(), ['user_id' => 'id']);
    }
    public function getAuthName(){
        return @$this->authAssignment->item_name;
    }
    
    public  function getProfile(){
        return @$this->hasOne(Profile::className(), ['user_id' => 'id']);
    }
    // virtual attribute hospitalName
    public function getFullName(){
        return @$this->profile->fullname;
    }

}

?>