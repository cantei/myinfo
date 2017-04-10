<?php

namespace app\modules\tuberculosis\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tb_clinical".
 *
 * @property string $TBNUMBER
 * @property string $SITES
 * @property string $GROUPS
 * @property string $AFB0
 * @property string $CXR
 * @property string $MDTCAT
 * @property string $MDTDATE
 * @property string $HIV
 */
class TbClinical extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_clinical';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SITES', 'GROUPS'], 'required'],
            [['MDTDATE'], 'safe'],
            [['MDTCAT'], 'string', 'max' => 50],
//            [['TBNUMBER'], 'string', 'max' => 6],
            [['SITES', 'GROUPS', 'AFB0', 'CXR'], 'string', 'max' => 25],

            [['HIV'], 'string', 'max' => 1],
            //            
            
        ];
    }

    /**
     * @inheritdoc
     */
 public function attributeLabels() {
        return [
            'ID' => 'ID',
            'TBNUMBER' => 'เลขทะเบียนวัณโรค',
            'SITES' => 'จำแนกผู้ป่วย',
            'GROUPS' => 'ประเภทผู้ป่วย',
            'AFB0' => 'ผลเสมหะครั้งแรก',
            'CXR' => 'ผลเอ็กซ์เรย์',
            'MDTCAT' => 'สูตรยา',
            'MDTDATE' => 'วันที่เริ่มกินยา',
            'HIV' => 'ผลตรวจ HIV',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbInfo()
    {
        return $this->hasOne(TbInfo::className(), ['TBNUMBER' => 'TBNUMBER']);
    }
    public static function itemsAlias($key) {

        $items = [           
            'sites' => [
                1 => 'ปอด',
                2 => 'นอกปอด',
                3 => 'ปอดและนอกปอด'
            ],
            'groups' => [
                1 => 'New',
                2 => 'Relapse',
                3 => 'TAF',
                4=>'TAD',
                5=>'Ti',
                6=>'Other'
            ],
           'cxr' => [
                1 => 'Normal',
                2 => 'Cavity',
                3 => 'No Cavity',
                4=>'Not done or Not Applicable',
            ],
            'hiv' => [
                1 => 'ไม่ยินยอม',
                2 => 'ผลบวก',
                3 => 'ผลลบ',               
            ],
        ];
        return ArrayHelper::getValue($items, $key, []);
    }

    public function getItemSites() {
        return self::itemsAlias('sites');
    }
    public function getSitesName() {
        return ArrayHelper::getValue($this->getItemSites(), $this->SITES);
    }
    
    public function getItemGroups() {
        return self::itemsAlias('groups');
    }
    
    public function getGroupsName() {
        return ArrayHelper::getValue($this->getItemGroups(), $this->GROUPS);
    }
    
    public function getItemCxr() {
        return self::itemsAlias('cxr');
    }
    
    public function getCxrName() {
        return ArrayHelper::getValue($this->getItemCxr(), $this->CXR);
    }
     
    public function getItemHiv() {
        return self::itemsAlias('hiv');
    }
    
    public function getHivName() {
        return ArrayHelper::getValue($this->getItemHiv(), $this->HIV);
    }
}