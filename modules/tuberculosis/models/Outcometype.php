<?php

namespace app\modules\tuberculosis\models;

use Yii;

/**
 * This is the model class for table "outcometype".
 *
 * @property integer $OUTCOME_ID
 * @property string $OUTCOME_NAME
 */
class Outcometype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outcometype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OUTCOME_ID'], 'required'],
            [['OUTCOME_ID'], 'integer'],
            [['OUTCOME_NAME'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'OUTCOME_ID' => 'Outcome  ID',
            'OUTCOME_NAME' => 'Outcome  Name',
        ];
    }
}
