<?php

namespace app\modules\tuberculosis\models;

use Yii;

/**
 * This is the model class for table "tb_conversions".
 *
 * @property string $TBNUMBER
 * @property string $DATE_SERV
 * @property string $CONVERSIONS
 * @property string $NOTE
 *
 * @property TbInfo $tBNUMBER
 */
class TbConversions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_conversions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TBNUMBER', 'CONVERSIONS'], 'required'],
            [['DATE_SERV'], 'safe'],
            [['NOTE'], 'string'],
            [['TBNUMBER'], 'string', 'max' => 6],
            [['CONVERSIONS'], 'string', 'max' => 15],
            [['TBNUMBER'], 'exist', 'skipOnError' => true, 'targetClass' => TbInfo::className(), 'targetAttribute' => ['TBNUMBER' => 'TBNUMBER']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TBNUMBER' => 'Tbnumber',
            'DATE_SERV' => 'Date  Serv',
            'CONVERSIONS' => 'Conversions',
            'NOTE' => 'Note',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTBNUMBER()
    {
        return $this->hasOne(TbInfo::className(), ['TBNUMBER' => 'TBNUMBER']);
    }
}
