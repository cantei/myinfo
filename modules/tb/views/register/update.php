<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TbInfo */

$this->title = 'แก้ไขทะเบียน' . $modelInfo->TBNUMBER;
$this->params['breadcrumbs'][] = ['label' => 'บัญชีรายชื่อ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'ดูรายละเอียด', 'url' => ['view', 'id' => $modelInfo->TBNUMBER]];
$this->params['breadcrumbs'][] = 'แก้ไขทะเบียน'
?>
<div class="tb-info-update">

    <h2><?php echo 'TB Number : '.(substr($modelInfo->TBNUMBER,2,4)*1).'/'.substr($modelInfo->TBNUMBER,0,2); ?></h2>

    <?= $this->render('_form', [
       'modelInfo' => $modelInfo,
         'modelClinical'=>$modelClinical
    ]) ?>

</div>
