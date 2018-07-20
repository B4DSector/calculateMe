<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Contacts;
use common\models\Tags;
use yii\widgets\ActiveForm;
use faravaghi\jalaliDatePicker\jalaliDatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Debts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="debts-form col-md-6">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'user_id')->textInput() ?>

    <?php //$form->field($model, 'contact_id')->textInput() ?>
    <?= $form->field($model, 'contact_id')->dropDownList(ArrayHelper::map(Contacts::find()
    ->select(['contact_id','contact_firstname','contact_lastname'])
    ->where(['user_id' => Yii::$app->user->identity->id])->all(), 'contact_id','DisplayName'),['class' => 'form-control inline-block']) ?>

    <?= $form->field($model, 'debt_amount')->textInput() ?>

    <?= $form->field($model, 'debt_date')->widget(
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

    <?= $form->field($model, 'debt_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'debt_tag_id')->dropDownList(ArrayHelper::map(Tags::find()
    ->select(['tag_id','tag_name'])->where(['user_id' => Yii::$app->user->identity->id])->all(), 'tag_id','tag_name'),[
        'class' => 'form-control inline-block'
        ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
