<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'contact_firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_nickname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_phone_number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
