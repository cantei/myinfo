<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\tb\models\TbOutcomes */

$this->title = 'Create Tb Outcomes';
$this->params['breadcrumbs'][] = ['label' => 'Tb Outcomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-outcomes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
