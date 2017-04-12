<?php

namespace app\modules\tb\models;

use Yii;

/**
 * This is the model class for table "bee".
 *
 * @property string $TBNUMBER
 * @property string $OUTCOME
 * @property string $DATE_DSC
 */
class Bee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TBNUMBER'], 'required'],
            [['DATE_DSC'], 'safe'],
            [['TBNUMBER'], 'string', 'max' => 6],
            [['OUTCOME'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TBNUMBER' => 'Tbnumber',
            'OUTCOME' => 'Outcome',
            'DATE_DSC' => 'Date  Dsc',
        ];
    }
}
