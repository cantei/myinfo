<?php

namespace app\modules\tb\models;

use Yii;

/**
 * This is the model class for table "cee".
 *
 * @property string $OUTCOME_ID
 * @property string $OUTCOME_NAME
 */
class Cee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OUTCOME_ID'], 'required'],
            [['OUTCOME_ID'], 'string', 'max' => 2],
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
