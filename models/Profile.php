<?php

namespace app\models;

use Yii;
use app\models\City;

/**
 * This is the model class for table "profile".
 *
 * @property int $user_id
 * @property string $name
 * @property int $city_id
 * @property string $address
 * @property string $birthday
 * @property int $phone
 * @property int $telegram_on
 * @property int $viber_on
 * @property int $whatsapp_on
 * @property string $skype
 * @property int $show_city
 * @property int $show_address
 * @property int $show_birthday
 * @property int $show_phone
 * @property int $show_skype
 * @property int $show_email
 *
 * @property City $city
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'city_id', 'phone', 'telegram_on', 'viber_on', 'whatsapp_on', 'show_city', 'show_address', 'show_birthday', 'show_phone', 'show_skype', 'show_email'], 'integer'],
            [['name', 'birthday', 'skype'], 'string', 'max' => 255],
            [['address'], 'string', 'max' => 512],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'name' => 'Name',
            'city_id' => 'City ID',
            'address' => 'Address',
            'birthday' => 'Birthday',
            'phone' => 'Phone',
            'telegram_on' => 'Telegram On',
            'viber_on' => 'Viber On',
            'whatsapp_on' => 'Whatsapp On',
            'skype' => 'Skype',
            'show_city' => 'Show City',
            'show_address' => 'Show Address',
            'show_birthday' => 'Show Birthday',
            'show_phone' => 'Show Phone',
            'show_skype' => 'Show Skype',
            'show_email' => 'Show Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}
