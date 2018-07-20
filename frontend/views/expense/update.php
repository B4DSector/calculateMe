<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Expenses */

$this->title = Yii::t('app', 'Update Expenses: ' . $model->expense_amount, [
    'nameAttribute' => '' . $model->expense_amount,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Expenses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->expense_amount, 'url' => ['view', 'id' => $model->expense_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="expenses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
