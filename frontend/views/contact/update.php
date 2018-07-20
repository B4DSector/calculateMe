<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Contacts */

$this->title = Yii::t('app', 'Update Contacts: ' . $model->contact_firstname . ' ' . $model->contact_lastname, [
    'nameAttribute' => '' . $model->contact_lastname,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->contact_lastname, 'url' => ['view', 'id' => $model->contact_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="contacts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
