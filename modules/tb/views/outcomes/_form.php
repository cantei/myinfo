<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\tb\models\TbOutcomes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-outcomes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TBNUMBER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OUTCOME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_DSC')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
