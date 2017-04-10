<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TbInfo */

$this->title = $model->TBNUMBER;
$this->params['breadcrumbs'][] = ['label' => 'บัญชีรายชื่อ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-info-view">

  <h2><?php echo 'TB Number : '.(substr($model->TBNUMBER,2,4)*1).'/'.substr($model->TBNUMBER,0,2); ?></h2>


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->TBNUMBER], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->TBNUMBER], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'TBNUMBER',
            'DATE_REG',
            'HMAIN',
            'HN',
            'PRENAME',
            'FNAME',
            'LNAME',
            'CID',
            'SEX',
            'AGE',
            'BW',
            'HNO',
            'VILLAGE_ID',
            'PHONE',
            'MEMO:ntext',
        ],
    ]) ?>

</div>
