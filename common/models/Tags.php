<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property int $tag_id
 * @property int $user_id
 * @property string $tag_name
 * @property string $tag_description
 *
 * @property Debts[] $debts
 * @property Demands[] $demands
 * @property Expenses[] $expenses
 * @property User $user
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tag_name'], 'required'],
            [['user_id'], 'integer'],
            [['tag_description'], 'string'],
            [['tag_name'], 'string', 'max' => 50],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tag_id' => Yii::t('app', 'Tag ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'tag_name' => Yii::t('app', 'Tag Name'),
            'tag_description' => Yii::t('app', 'Tag Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDebts()
    {
        return $this->hasMany(Debts::className(), ['debt_tag_id' => 'tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDemands()
    {
        return $this->hasMany(Demands::className(), ['demand_tag_id' => 'tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenses()
    {
        return $this->hasMany(Expenses::className(), ['expense_tag_id' => 'tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
