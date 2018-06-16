<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Demands */

$this->title = $model->demand_amount;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Demands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demands-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->demand_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->demand_id], [
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
            'demand_id',
            'user_id',
            'contact_id',
            'demand_amount',
            'demand_date',
            'demand_description:ntext',
            'demand_tag_id',
        ],
    ]) ?>

</div>
