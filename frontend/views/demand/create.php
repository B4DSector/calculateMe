<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Demands */

$this->title = Yii::t('app', 'Create Demands');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Demands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demands-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
