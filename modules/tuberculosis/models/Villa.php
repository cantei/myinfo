<?php

namespace app\modules\tuberculosis\models;

use Yii;

/**
 * This is the model class for table "villa".
 *
 * @property string $VILLAGE_ID
 * @property string $VILLAGE_CODE
 * @property string $VILLAGE_NAME
 * @property string $HOSPCODE
 * @property string $HOSPNAME
 * @property integer $SUBDIST_ID
 * @property string $SUBDIST_CODE
 * @property string $SUBDIST_NAME
 * @property integer $AMPHUR_ID
 * @property string $AMPHUR_CODE
 * @property string $AMPHUR_NAME
 */
class Villa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'villa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['VILLAGE_ID'], 'required'],
            [['SUBDIST_ID', 'AMPHUR_ID'], 'integer'],
            [['VILLAGE_ID', 'SUBDIST_CODE'], 'string', 'max' => 8],
            [['VILLAGE_CODE'], 'string', 'max' => 2],
            [['VILLAGE_NAME', 'HOSPNAME', 'SUBDIST_NAME'], 'string', 'max' => 255],
            [['HOSPCODE'], 'string', 'max' => 5],
            [['AMPHUR_CODE'], 'string', 'max' => 4],
            [['AMPHUR_NAME'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'VILLAGE_ID' => 'Village  ID',
            'VILLAGE_CODE' => 'Village  Code',
            'VILLAGE_NAME' => 'Village  Name',
            'HOSPCODE' => 'Hospcode',
            'HOSPNAME' => 'Hospname',
            'SUBDIST_ID' => 'Subdist  ID',
            'SUBDIST_CODE' => 'Subdist  Code',
            'SUBDIST_NAME' => 'Subdist  Name',
            'AMPHUR_ID' => 'Amphur  ID',
            'AMPHUR_CODE' => 'Amphur  Code',
            'AMPHUR_NAME' => 'Amphur  Name',
        ];
    }
}
