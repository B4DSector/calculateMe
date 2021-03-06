<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Tags;
use yii\widgets\ActiveForm;
use faravaghi\jalaliDatePicker\jalaliDatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Expenses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expenses-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'expense_amount')->textInput() ?>

    <?= $form->field($model, 'expense_date')->widget(
		jalaliDatePicker::className(), [
		'options' => array(
			'format' => 'yyyy-mm-dd',
			'viewformat' => 'yyyy/mm/dd',
			'placement' => 'left',
			'todayBtn'=> 'linked',
		),
		'htmlOptions' => [
			'id' => 'date',
			'class'	=> 'form-control'
		]
	]);?>

    <?= $form->field($model, 'expense_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'expense_tag_id')->dropDownList(ArrayHelper::map(Tags::find()
    ->select(['tag_id','tag_name'])->where(['user_id' => Yii::$app->user->identity->id])->all(), 'tag_id','tag_name'),[
        'class' => 'form-control inline-block'
        ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
