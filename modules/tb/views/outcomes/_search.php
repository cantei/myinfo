<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\tb\models\TbOutcomesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-outcomes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'TBNUMBER') ?>

    <?= $form->field($model, 'OUTCOME') ?>

    <?= $form->field($model, 'DATE_DSC') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
