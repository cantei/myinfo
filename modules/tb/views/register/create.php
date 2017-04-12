<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TbInfo */

$this->title = 'ขึ้นทะเบียน';
$this->params['breadcrumbs'][] = ['label' => 'บัญชีรายชื่อ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-info-create">

    <h1><?php //echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
            'modelInfo' => $modelInfo,
            'modelClinical'=>$modelClinical
    ]) ?>

</div>
