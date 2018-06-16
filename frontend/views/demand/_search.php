<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SearchDemands */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="demands-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //$form->field($model, 'demand_id') ?>

    <?php //$form->field($model, 'user_id') ?>

    <?= $form->field($model, 'contact_id') ?>

    <?= $form->field($model, 'demand_amount') ?>

    <?= $form->field($model, 'demand_date') ?>
    <!-- Qu: What is this for? Comment or not comment no difference!!! -->
    <?php echo $form->field($model, 'demand_description') ?>

    <?php echo $form->field($model, 'demand_tag_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
