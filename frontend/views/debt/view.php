<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Contacts;
use common\models\Tags;
/* @var $this yii\web\View */
/* @var $model common\models\Debts */

$this->title = $model->debt_amount;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Debts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="debts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->debt_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->debt_id], [
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
            // 'debt_id',
            // 'user_id',
            [
                'attribute' => 'contact_id',
                'label' => 'Contact',
                'value' => function($model){
                    $name = Contacts::find()->select(['contact_firstname', 'contact_lastname'])->where(['user_id' => Yii::$app->user->identity->id,'contact_id' => $model->contact_id])->one();
                    return $name->contact_firstname . " " . $name->contact_lastname;
                }
            ],
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
        ],
    ]) ?>

</div>
