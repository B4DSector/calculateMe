<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Debts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="debts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'contact_id')->textInput() ?>

    <?= $form->field($model, 'debt_amount')->textInput() ?>

    <?= $form->field($model, 'debt_date')->textInput() ?>

    <?= $form->field($model, 'debt_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'debt_tag_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
