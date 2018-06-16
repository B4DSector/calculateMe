<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Debts */

$this->title = Yii::t('app', 'Create Debts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Debts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="debts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
