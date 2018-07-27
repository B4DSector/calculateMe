<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "debts".
 *
 * @property int $debt_id
 * @property int $user_id
 * @property int $contact_id
 * @property int $debt_amount
 * @property string $debt_date
 * @property string $debt_ttp
 * @property string $debt_description
 * @property int $debt_tag_id
 *
 * @property Contacts $contact
 * @property Tags $debtTag
 * @property User $user
 */
class Debts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'debts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contact_id', 'debt_amount', 'debt_date', 'debt_description', 'debt_tag_id'], 'required'],
            [['user_id', 'contact_id', 'debt_amount', 'debt_tag_id'], 'integer'],
            [['debt_date','debt_ttp'], 'safe'],
            [['debt_description'], 'string'],
            [['contact_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::className(), 'targetAttribute' => ['contact_id' => 'contact_id']],
            [['debt_tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tags::className(), 'targetAttribute' => ['debt_tag_id' => 'tag_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'debt_id' => Yii::t('app', 'Debt ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'contact_id' => Yii::t('app', 'Contact'),
            'debt_amount' => Yii::t('app', 'Debt Amount (Toman)'),
            'debt_date' => Yii::t('app', 'Debt Date'),
            'debt_ttp' => Yii::t('app', 'Time to Pay Date'),
            'debt_description' => Yii::t('app', 'Debt Description'),
            'debt_tag_id' => Yii::t('app', 'Tag'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(Contacts::className(), ['contact_id' => 'contact_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDebtTag()
    {
        return $this->hasOne(Tags::className(), ['tag_id' => 'debt_tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
