<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "option_value_g".
 *
 * @property int $product_id
 * @property int $option_id
 * @property string $value
 */
class OptionValueGoods extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function primaryKey()
    {
        return ['product_id', 'option_id', 'value'];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'option_value_g';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'option_id'], 'required'],
            [['product_id', 'option_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
//            [['product_id', 'option_id'], 'unique', 'targetAttribute' => ['product_id', 'option_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'option_id' => 'Option ID',
            'value' => 'Value',
        ];
    }
}
