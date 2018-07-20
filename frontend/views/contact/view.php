<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\models\Tags;
/* @var $this yii\web\View */
/* @var $model common\models\Contacts */

$this->title = $model->contact_lastname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->contact_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->contact_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'contact_firstname',
            'contact_lastname',
            'contact_nickname',
            'contact_email:email',
            'contact_phone_number',
        ],
    ]) ?>

    <br/>
    <h1><?= Yii::t('app', 'Depts') ?></h1>

    <?= GridView::widget([
        'dataProvider' => $debtsDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'debt_amount',
            'debt_date',
            'debt_description:ntext',
            [
                'attribute' => 'debt_tag_id',
                'label' => 'Tag',
                'value' => function($model){
                    $tag = Tags::find()->select(['tag_name'])->where(['user_id' => Yii::$app->user->identity->id,'tag_id' => $model->debt_tag_id])->one();
                    return $tag->tag_name;
                } 
            ],


            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'debt',
            ],
        ],
        'options'=>[
            'class' => 'table table-bordered table-hover dataTable',
        ]
    ]); ?>
    <br/>
    <h1><?= Yii::t('app', 'Demands') ?></h1>
    <?= GridView::widget([
        'dataProvider' => $demandsDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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


            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'demand',
            ],
        ],
        'options'=>[
            'class' => 'table table-bordered table-hover dataTable',
        ]
    ]); ?>

    <br/>
    <h3><?= Yii::t('app', 'Total') ?> : </h3>

    <?php
        if($total < 0){
            $class = 'text-danger';
        }else{
            $class = 'text-success';
        }
    ?>

    <h4 class="<?= $class ?>"><?= $total ?> <?= Yii::t('app', '(Toman)') ?></h4>
</div>
