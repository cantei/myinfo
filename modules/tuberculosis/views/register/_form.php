<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\widgets\DepDrop;

use app\models\Province;
use app\modules\tuberculosis\models\District;
use app\models\Subdistrict;
?>


    <?php $form = ActiveForm::begin([ 
            'enableAjaxValidation' => true,
//          'validationUrl' => Url::toRoute('tb-register/validation')
            ]);
    ?>
   <div class="panel panel-default">
    <div class="panel-body">
        <h4  style="color:#5cb85c;"><i><b>Personal Info</b></i></h4><hr>
    <div class="row">
        <div class="col-sm-3 col-md-3">
             <?= DatePicker::widget([
                    'model' => $modelInfo,
                    'form' => $form,
                    'attribute' => 'DATE_REG',
                    'pluginOptions' => [
                        'format' => 'yyyy-M-dd',
                        'todayHighlight' => true,
                        'clearButton' => false,
                        'autoclose'=>true,
                    ]
                ]);
            ?>
        </div>
        <div class="col-sm-3 col-md-3">
            <?= $form->field($modelInfo, 'TBNUMBER') ?>   
        </div>
        <div class="col-sm-3 col-md-3">
             <?= $form->field($modelInfo, 'HN')->textInput(['maxlength' => 7]) ?>   
        </div>
        <div class="col-sm-3 col-md-3">
            <?= $form->field($modelInfo, 'CID')->textInput(['maxlength' => 13]) ?>
        </div>        
    </div>
    <div class="row">
        <div class="col-sm-3 col-md-3">
             <?= $form->field($modelInfo, 'FNAME')->textInput(['maxlength' => 30]) ?>
        </div>
        <div class="col-sm-3 col-md-3">
             <?= $form->field($modelInfo, 'LNAME')->textInput(['maxlength' => 50]) ?>
        </div>
        <div class="col-sm-3 col-md-2">
            <?= $form->field($modelInfo, 'SEX')->dropdownList($modelInfo->getItemSex());   ?>
        </div>
        <div class="col-sm-2 col-md-2">
             <?= $form->field($modelInfo, 'AGE') ?>
        </div>        
        <div class="col-sm-2 col-md-2">
             <?= $form->field($modelInfo, 'BW') ?>
        </div>       
    </div> 
    <div class="row">
        <div class="col-sm-2 col-md-2">
            <?= $form->field($modelInfo, 'DISTRICT')->dropdownList(
                    ArrayHelper::map(District::find()->where(['PROVINCE_ID' => 54])->all(),
                    'AMPHUR_ID',
                    'AMPHUR_NAME'),
                    [
                        'id'=>'ddl-district',
                        'prompt'=>'เลือกอำเภอ...'
                ]); 
            ?>

        </div>
        <div class="col-sm-2 col-md-2">
            <?= $form->field($modelInfo, 'SUBDISTRICT')->widget(DepDrop::classname(), [
                'options'=>['id'=>'ddl-subdistrict'],
                'data' =>[], //<---------
                'pluginOptions'=>[
                    'depends'=>['ddl-district'],
                    'placeholder'=>'เลือกตำบล...',
                    'url'=>Url::to(['/tuberculosis/register/get-subdistrict'])
                ]
                ]); 
            ?>
        </div>
        <div class="col-sm-2 col-md-2">
             <?= $form->field($modelInfo, 'VILLA')->widget(DepDrop::classname(), [
                    'options'=>['id'=>'ddl-villa'],
                    'data' =>[], //<---------
                    'pluginOptions'=>[
                    'depends'=>['ddl-district','ddl-subdistrict'],
                    'placeholder'=>'เลือกหมู่...',
                    'url'=>Url::to(['/tuberculosis/register/get-villa'])
                ]
                ]); 
            ?>
        </div>
        <div class="col-sm-2 col-md-2">
              <?= $form->field($modelInfo, 'HNO')->textInput(['maxlength' => 30]) ?>
        </div>
        <div class="col-sm-2 col-md-2">
                <?php echo $form->field($modelInfo, 'PHONE')->textInput(['maxlength' => 10]) ?>
        </div>
       
    </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <?php echo  $form->field($modelInfo, 'MEMO')->textarea(['rows' => '2']) ?>
            </div>
        </div>
    </div>
   </div>

<!-- ----------------------this is clinical data--------------------------------- -->
   <div class="panel panel-default">
        <div class="panel-body">
            <h4  style="color:#428bca;"><i><b>Clinical Info</b></i></h4><hr>
            <div class="row">
                <div class="col-sm-3 col-md-3">
                    <?= DatePicker::widget([
                            'model' => $modelClinical,
                            'form' => $form,
                            'attribute' => 'MDTDATE',
                            'pluginOptions' => [
                                'format' => 'yyyy-M-dd',
                                'todayHighlight' => true,
                                'clearButton' => false,
                                'autoclose'=>true,
                            ]
                        ]);
                    ?>
                </div>
                <div class="col-sm-3 col-md-3">
                    <?= $form->field($modelClinical, 'MDTCAT') ?>
                </div>
                <div class="col-sm-2 col-md-2">
                      <?= $form->field($modelClinical, 'SITES')->radioList($modelClinical->getItemSites()); ?>
                </div>
                <div class="col-sm-2 col-md-2">
                     <?= $form->field($modelClinical, 'GROUPS')->radioList($modelClinical->getItemGroups());  ?>
                </div>
                <div class="col-sm-2 col-md-2">
                    <?= $form->field($modelClinical, 'CXR')->radioList($modelClinical->getItemCxr());  ?>
                </div>
            </div> <!-- end row1 -->
            <div class="row">

                <div class="col-sm-3 col-md-3">
                    <?= $form->field($modelClinical, 'AFB0') ?>
                </div>
                <div class="col-sm-3 col-md-3">
                     <?= $form->field($modelClinical, 'HIV')->dropdownList($modelClinical->getItemHiv());  ?>
                </div>
            </div>   <!-- end row2 -->     
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('ตกลง', ['class' => 'btn btn-success'.' btn-lg btn-block']) ?>
    </div>

<?php ActiveForm::end(); ?>
