<?php

namespace app\models;

use Yii;

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
            [['from_id', 'to_id', 'operation', 'created_at', 'updated_at', 'status'], 'integer'],
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
            'from_id' => 'From ID',
            'to_id' => 'To ID',
            'operation' => 'Operation',
            'message' => 'Message',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }
}
