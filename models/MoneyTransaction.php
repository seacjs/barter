<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "money_transaction".
 *
 * @property int $id
 * @property int $from_id
 * @property int $to_id
 * @property int $operation
 * @property string $message
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 */
class MoneyTransaction extends \yii\db\ActiveRecord
{

    const STATUS_HOLD = 0;
    const STATUS_SUCCESS = 10;

    /* todo: перенести константы операций в одно место или разделить их по сущностям, лучше конечно по сущностями, но тогад надо поправить moneySystem */
    const OPERATION_ADD_MONEY_TO_USER = 4;
    const OPERATION_REMOVE_MONEY_FROM_USER = 5;

    const OPERATION_TRANSACTION = 10;
    const OPERATION_DEAL = 11;

    public $user_id;

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
        return 'money_transaction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from_id','user_id', 'to_id', 'operation', 'created_at', 'updated_at', 'status', 'value'], 'integer'],
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
            'value' => 'Value',
            'from_id' => 'From ID',
            'to_id' => 'To ID',
            'user_id' => 'User ID',
            'operation' => 'Operation',
            'message' => 'Message',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }
}
