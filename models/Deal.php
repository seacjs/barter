<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "deal".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $product_type
 * @property int $product_id
 * @property int $transaction_id
 * @property int $status
 *
 * @property MoneyTransaction $transaction
 */
class Deal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'deal';
    }

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
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'product_id', 'transaction_id', 'status'], 'integer'],
            [['product_type'], 'string', 'max' => 255],
            [['transaction_id'], 'exist', 'skipOnError' => true, 'targetClass' => MoneyTransaction::className(), 'targetAttribute' => ['transaction_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'product_type' => 'Product Type',
            'product_id' => 'Product ID',
            'transaction_id' => 'Transaction ID',
            'status' => 'Status',
        ];
    }

    public function getProducts()
    {

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaction()
    {
        return $this->hasOne(MoneyTransaction::className(), ['id' => 'transaction_id']);
    }
}
