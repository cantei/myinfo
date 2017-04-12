<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\tb\models\TbOutcomesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tb Outcomes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-outcomes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tb Outcomes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TBNUMBER',
            'OUTCOME',
            'DATE_DSC',
            'outcomeType.OUTCOME_NAME',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
