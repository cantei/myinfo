<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Chospital;
/**
 * @var yii\web\View              $this
 * @var yii\widgets\ActiveForm    $form
 * @var dektrium\user\models\User $user
 */
$this->title = Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
       </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'registration-form',
                	        /* add hoscode */            ]); ?>
                
                <?= $form->field($model, 'fullname') ?>       <!-- add fullname-->  
                <?php  /* add hoscode */        
                    $listOffice=ArrayHelper::map(Chospital::find()->where(['provcode'=>'67','distcode'=>'01'])
                                              	->asArray()->all(),'hoscode','hosname');
                    echo $form->field($model, 'hoscode')->dropDownList($listOffice,[
                        'prompt'=>'--- กรุณาเลือก ---'
                    		]);?>        
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>           
                <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-success btn-block']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <p class="text-center">
            <?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
        </p>
    </div>
</div>

