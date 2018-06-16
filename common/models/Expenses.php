<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "expenses".
 *
 * @property int $expense_id
 * @property int $user_id
 * @property int $expense_amount
 * @property string $expense_date
 * @property string $expense_description
 * @property int $expense_tag_id
 *
 * @property Tags $expenseTag
 * @property User $user
 */
class Expenses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expenses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'expense_amount', 'expense_date', 'expense_description', 'expense_tag_id'], 'required'],
            [['user_id', 'expense_amount', 'expense_tag_id'], 'integer'],
            [['expense_date'], 'safe'],
            [['expense_description'], 'string'],
            [['expense_tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tags::className(), 'targetAttribute' => ['expense_tag_id' => 'tag_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'expense_id' => Yii::t('app', 'Expense ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'expense_amount' => Yii::t('app', 'Expense Amount'),
            'expense_date' => Yii::t('app', 'Expense Date'),
            'expense_description' => Yii::t('app', 'Expense Description'),
            'expense_tag_id' => Yii::t('app', 'Tag'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenseTag()
    {
        return $this->hasOne(Tags::className(), ['tag_id' => 'expense_tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
