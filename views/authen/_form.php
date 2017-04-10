<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'username')->textInput(['readonly' => !$model->isNewRecord])  ?>
    

    <?php echo $form->field($model, 'email')->textInput(['readonly' => !$model->isNewRecord]) ?>
    
    <?php echo $form->field($model, 'FullName')->textInput(['readonly' => !$model->isNewRecord])  ?>
    
    <?php echo $form->field($auth, 'authname')->radioList(\app\models\AuthenForm::itemsAlias('authname')) ?>
    

    <?php // echo  $form->field($model, 'confirmed_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
