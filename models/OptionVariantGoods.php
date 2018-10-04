<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "option_variant_g".
 *
 * @property int $id
 * @property int $option_id
 * @property string $name
 * @property string $value
 *
 * @property OptionG $option
 */
class OptionVariantGoods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'option_variant_g';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['option_id'], 'integer'],
            [['name', 'value'], 'string', 'max' => 255],
            [['option_id'], 'exist', 'skipOnError' => true, 'targetClass' => OptionGoods::class, 'targetAttribute' => ['option_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'option_id' => 'Option ID',
            'name' => 'Name',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOption()
    {
        return $this->hasOne(OptionGoods::class, ['id' => 'option_id']);
    }
}
