<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\tb\models\TbOutcomes */

$this->title = 'Update Tb Outcomes: ' . $model->TBNUMBER;
$this->params['breadcrumbs'][] = ['label' => 'Tb Outcomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TBNUMBER, 'url' => ['view', 'id' => $model->TBNUMBER]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tb-outcomes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
