<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TbInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'บัญชีรายชื่อ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-info-index">
<?php if(!Yii::$app->user->isGuest){echo Yii::$app->user->identity->profile->hoscode;} ?>
    <h1><?php // echo Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('ขึ้นทะเบียน', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TBNUMBER',
            'DATE_REG',
//            'HMAIN',
//            'HN',
//            'PRENAME',
             'FNAME',
             'LNAME',
            // 'CID',
            // 'SEX',
            // 'AGE',
            // 'BW',
             'HNO',
             'VILLAGE_ID',
            // 'PHONE',
            // 'MEMO:ntext',

        [
            'class' => 'yii\grid\ActionColumn',
            'buttonOptions' => ['class' => 'btn btn-default'],
            'template' => '<div class="btn-group btn-group-sm text-center" role="group">{view} {update} {delete} </div>',
            'options' => ['style' => 'width:120px;'],
            'buttons' => [
                'copy' => function($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-duplicate"></i>', $url, ['class' => 'btn btn-default']);
                }
                    ]
        ],
        ],
    ]); ?>
</div>
