<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SearchExpenses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expenses-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //$form->field($model, 'expense_id') ?>

    <?php //$form->field($model, 'user_id') ?>

    <?= $form->field($model, 'expense_amount') ?>

    <?= $form->field($model, 'expense_date') ?>

    <?= $form->field($model, 'expense_description') ?>

    <?php  echo $form->field($model, 'expense_tag_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
