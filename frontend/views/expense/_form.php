<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Expenses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expenses-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'expense_amount')->textInput() ?>

    <?= $form->field($model, 'expense_date')->textInput() ?>

    <?= $form->field($model, 'expense_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'expense_tag_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
