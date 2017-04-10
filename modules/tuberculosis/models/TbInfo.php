<?php

namespace app\modules\tuberculosis\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tb_info".
 *
 * @property string $TBNUMBER
 * @property string $DATE_REG
 * @property string $HMAIN
 * @property string $HN
 * @property string $PRENAME
 * @property string $FNAME
 * @property string $LNAME
 * @property string $CID
 * @property string $SEX
 * @property integer $AGE
 * @property integer $BW
 * @property string $HNO
 * @property string $VILLAGE_ID
 * @property string $PHONE
 * @property string $MEMO
 */
class TbInfo extends \yii\db\ActiveRecord {

    const SEX_MEN = 1;
    const SEX_WOMEN = 2;

    public $DISTRICT;
    public $SUBDISTRICT;
    public $VILLA;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tb_info';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['TBNUMBER'], 'unique', 'message' => 'เลขทะเบียนนี้ถูกบันทึกแล้ว'],
            [['FNAME', 'LNAME', 'TBNUMBER'], 'required'],
            [['TBNUMBER'], 'is6NumbersOnly'],
            [['HN'], 'is7NumbersOnly'],
            [['CID'], 'is13NumbersOnly'],
            [['SEX'], 'string', 'max' => 1],
            [['AGE', 'BW'], 'integer'],
            [['DATE_REG', 'DISTRICT', 'SUBDISTRICT', 'VILLA', 'HNO'], 'required'],
            ['HNO', 'safe'],
            ['PHONE', 'safe'],
            ['MEMO', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'TBNUMBER' => 'เลขทะเบียนวัณโรค',
            'DATE_REG' => 'วันที่ขึนทะเบียน',
            'HMAIN' => 'Hmain',
            'HN' => 'HN',
            'PRENAME' => 'คำนำหน้า',
            'FNAME' => 'ชื่อ',
            'LNAME' => 'สกุล',
            'CID' => 'เลขประจำตัวประชาชน',
            'SEX' => 'เพศ',
            'AGE' => 'อายุ',
            'BW' => 'น้ำหนัก',
            'HNO' => 'บ้านเลขที่',
            'VILLAGE_ID' => 'หมู่',
            'VILLA' => 'หมู่บ้าน',
            'PHONE' => 'โทรศัพท์',
            'MEMO' => 'หมายเหตุ',
            'DISTRICT' => 'อำเภอ',
            'SUBDISTRICT' => 'ตำบล'
        ];
    }

    public function getTbClinical() {
        return $this->hasOne(TbClinical::className(), ['TBNUMBER' => 'TBNUMBER']);
    }

    public function getVilla() {
        return $this->hasOne(Villa::className(), ['VILLAGE_ID' => 'VILLAGE_ID']);
    }

    public function getVillageName() {
        return $this->villa->VILLAGE_NAME;
    }

    public function getSubdistName() {
//        return $this->villa->SUBDIST_NAME;
        return $this->villa->SUBDIST_NAME;
    }

    public function getHospcode() {
        return $this->villa->HOSPCODE;
    }

    public static function itemsAlias($key) {

        $items = [
            'sex' => [
                self::SEX_MEN => 'ชาย',
                self::SEX_WOMEN => 'หญิง'
            ],
            'title' => [
                1 => 'นาย',
                2 => 'นางสาว',
                3 => 'นาง'
            ],
            'sites' => [
                1 => 'ปอด',
                2 => 'นอกปอด',
                3 => 'รวม',
            ],
        ];
        return ArrayHelper::getValue($items, $key, []);
    }

    public function getItemSex() {
        return self::itemsAlias('sex');
    }

    public function getSexName() {
        return ArrayHelper::getValue($this->getItemSex(), $this->SEX);
    }

    public function is6NumbersOnly($attribute) {
        if (!preg_match('/^[0-9]{6}$/', $this->$attribute)) {
            $this->addError($attribute, 'TB NUMBER  enter only  6 digits of  number .');
        }
    }

    public function is7NumbersOnly($attribute) {
        if (!preg_match('/^[0-9]{7}$/', $this->$attribute)) {
            $this->addError($attribute, 'HN  enter only  7 digits of  number.');
        }
    }

    public function is13NumbersOnly($attribute) {
        if (!preg_match('/^[0-9]{13}$/', $this->$attribute)) {
            $this->addError($attribute, 'CID  enter only  13 digits of  number.');
        }
    }
  
}
    