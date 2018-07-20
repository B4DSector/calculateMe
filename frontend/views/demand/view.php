<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Contacts;
use common\models\Tags;
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
        ],
    ]) ?>

</div>
