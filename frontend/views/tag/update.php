<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tags */

$this->title = Yii::t('app', 'Update Tags: ' . $model->tag_name, [
    'nameAttribute' => '' . $model->tag_name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tag_name, 'url' => ['view', 'id' => $model->tag_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tags-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
