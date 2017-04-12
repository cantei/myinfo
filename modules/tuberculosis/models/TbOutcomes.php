<?php

namespace app\modules\tuberculosis\models;

use Yii;

/**
 * This is the model class for table "tb_outcomes".
 *
 * @property string $TBNUMBER
 * @property string $OUTCOME
 * @property string $DATE_DSC
 */
class TbOutcomes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_outcomes';
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
