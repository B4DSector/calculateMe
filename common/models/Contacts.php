<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property int $contact_id
 * @property int $user_id
 * @property string $contact_firstname
 * @property string $contact_lastname
 * @property string $contact_nickname
 * @property string $contact_email
 * @property string $contact_phone_number
 *
 * @property User $user
 * @property Debts[] $debts
 * @property Demands[] $demands
 */
class Contacts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contact_firstname', 'contact_lastname'], 'required'],
            [['user_id'], 'integer'],
            [['contact_firstname', 'contact_lastname', 'contact_nickname'], 'string', 'max' => 50],
            [['contact_email', 'contact_phone_number'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'contact_id' => Yii::t('app', 'Contact ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'contact_firstname' => Yii::t('app', 'Contact Firstname'),
            'contact_lastname' => Yii::t('app', 'Contact Lastname'),
            'contact_nickname' => Yii::t('app', 'Contact Nickname'),
            'contact_email' => Yii::t('app', 'Contact Email'),
            'contact_phone_number' => Yii::t('app', 'Contact Phone Number'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDebts()
    {
        return $this->hasMany(Debts::className(), ['contact_id' => 'contact_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDemands()
    {
        return $this->hasMany(Demands::className(), ['contact_id' => 'contact_id']);
    }

    public function getDisplayName(){
        return $this->contact_firstname . " " . $this->contact_lastname;
    }
}
