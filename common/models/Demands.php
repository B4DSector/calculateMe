<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "demands".
 *
 * @property int $demand_id
 * @property int $user_id
 * @property int $contact_id
 * @property int $demand_amount
 * @property string $demand_date
 * @property string $demand_description
 * @property int $demand_tag_id
 *
 * @property Contacts $contact
 * @property Tags $demandTag
 * @property User $user
 */
class Demands extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'demands';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contact_id', 'demand_amount', 'demand_date', 'demand_description', 'demand_tag_id'], 'required'],
            [['user_id', 'contact_id', 'demand_amount', 'demand_tag_id'], 'integer'],
            [['demand_date'], 'safe'],
            [['demand_description'], 'string'],
            [['contact_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::className(), 'targetAttribute' => ['contact_id' => 'contact_id']],
            [['demand_tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tags::className(), 'targetAttribute' => ['demand_tag_id' => 'tag_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'demand_id' => Yii::t('app', 'Demand ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'contact_id' => Yii::t('app', 'Contact ID'),
            'demand_amount' => Yii::t('app', 'Demand Amount'),
            'demand_date' => Yii::t('app', 'Demand Date'),
            'demand_description' => Yii::t('app', 'Demand Description'),
            'demand_tag_id' => Yii::t('app', 'Demand Tag ID'),
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
    public function getDemandTag()
    {
        return $this->hasOne(Tags::className(), ['tag_id' => 'demand_tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
