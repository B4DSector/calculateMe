<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Demands */

$this->title = Yii::t('app', 'Update Demands: ' . $model->demand_amount, [
    'nameAttribute' => '' . $model->demand_amount,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Demands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->demand_amount, 'url' => ['view', 'id' => $model->demand_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="demands-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
