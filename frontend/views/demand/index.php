<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchDemands */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Demands');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demands-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Demands'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'demand_id',
            //'user_id',
            'contact_id',
            'demand_amount',
            'demand_date',
            'demand_description:ntext',
            'demand_tag_id',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
