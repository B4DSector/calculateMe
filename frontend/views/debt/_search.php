<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SearchDebts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="debts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //$form->field($model, 'debt_id') ?>

    <?php //$form->field($model, 'user_id') ?>

    <?= $form->field($model, 'contact_id') ?>

    <?= $form->field($model, 'debt_amount') ?>

    <?= $form->field($model, 'debt_date') ?>

    <?= $form->field($model, 'debt_ttp') ?>

    <?php  echo $form->field($model, 'debt_description') ?>

    <?php  echo $form->field($model, 'debt_tag_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
