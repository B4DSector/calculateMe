<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Debts */

$this->title = Yii::t('app', 'Update Debts: ' . $model->debt_amount, [
    'nameAttribute' => '' . $model->debt_amount,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Debts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->debt_amount, 'url' => ['view', 'id' => $model->debt_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="debts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
