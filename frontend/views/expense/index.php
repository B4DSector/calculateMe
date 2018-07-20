<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Tags;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchExpenses */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Expenses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenses-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <h4>۳۱ روز گذشته :<?php echo $amount ?> <?= Yii::t('app', '(Toman)') ?></h4>
    <p>
        <?= Html::a(Yii::t('app', 'Create Expenses'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'expense_id',
            //'user_id',
            'expense_amount',
            'expense_date',
            'expense_description:ntext',
            [
                'attribute' => 'expense_tag_id',
                'label' => 'Tag',
                'value' => function($model){
                    $tag = Tags::find()->select(['tag_name'])->where(['user_id' => Yii::$app->user->identity->id,'tag_id' => $model->expense_tag_id])->one();
                    return $tag->tag_name;
                } 
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'options'=>[
                'class' => 'table table-bordered table-hover dataTable',
        ]
    ]); ?>
    
</div>
