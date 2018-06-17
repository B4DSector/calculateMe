<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Tags */

$this->title = $model->tag_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tags-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->tag_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->tag_id], [
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
            // 'tag_id',
            // 'user_id',
            'tag_name',
            'tag_description:ntext',
        ],
    ]) ?>

    <h1><?= Yii::t('app', 'Expenses') ?></h1>    
    <?= GridView::widget([
        'dataProvider' => $expenseDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'expense_id',
            //'user_id',
            'expense_amount',
            'expense_date',
            'expense_description:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'expense',
            ],
        ],
    ]); ?>

</div>
