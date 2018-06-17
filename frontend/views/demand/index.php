<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Contacts;
use common\models\Tags;

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
            [
                'attribute' => 'contact_id',
                'label' => 'Contact',
                'value' => function($model){
                    $name = Contacts::find()->select(['contact_firstname', 'contact_lastname'])->where(['user_id' => Yii::$app->user->identity->id,'contact_id' => $model->contact_id])->one();
                    return $name->contact_firstname . " " . $name->contact_lastname;
                }
            ],
            'demand_amount',
            'demand_date',
            'demand_description:ntext',
            [
                'attribute' => 'demand_tag_id',
                'label' => 'Tag',
                'value' => function($model){
                    $tag = Tags::find()->select(['tag_name'])->where(['user_id' => Yii::$app->user->identity->id,'tag_id' => $model->demand_tag_id])->one();
                    return $tag->tag_name;
                } 
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <br/>
    <h3><?= Yii::t('app', 'Total') ?> : </h3>
    <h4 class="text-success"><?= $total ?> <?= Yii::t('app', '(Toman)') ?></h4>
</div>
