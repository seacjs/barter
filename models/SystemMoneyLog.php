<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "system_money_log".
 *
 * @property int $id
 * @property int $user_id
 * @property string $message
 * @property int $operation
 * @property int $created_at
 * @property int $updated_at
 */
class SystemMoneyLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'system_money_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'operation', 'created_at', 'updated_at', 'value'], 'integer'],
            [['message'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'message' => 'Message',
            'value' => 'Value',
            'operation' => 'Operation',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
