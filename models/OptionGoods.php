<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "option_g".
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property int $type
 * @property string $typeName
 * @property array $types
 *
 * @property CategoryGoods $category
 * @property OptionVariant[] $optionVariants
 */
class OptionGoods extends \yii\db\ActiveRecord
{

    const TYPE_CHECKBOX = 0;
    const TYPE_STRING = 1;
    const TYPE_TEXT = 2;
    const TYPE_MULTI_CHECKBOX = 3;
    const TYPE_SELECT = 4;
    const TYPE_COLOR = 5;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'option_g';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'type'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryGoods::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'category_id' => 'Category ID',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(CategoryGoods::class, ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptionVariants()
    {
        return $this->hasMany(OptionVariantGoods::class, ['option_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptionVariantsArray()
    {
        return $this->hasMany(OptionVariantGoods::class, ['option_id' => 'id'])->indexBy('id')->asArray();
    }

    /**
     * Return list of option types
     * @return array
     */
    public static function getTypes()
    {
        return [
            self::TYPE_CHECKBOX  => 'Чекбокс',
            self::TYPE_STRING  => 'Ввод данных строка',
            self::TYPE_TEXT  => 'Ввод данных текст',
            self::TYPE_MULTI_CHECKBOX  => 'Мультичекбокс',
            self::TYPE_SELECT  => 'Селект',
            self::TYPE_COLOR => 'Выбор цвета',
        ];
    }

    /**
     * Return type name of this option
     * @return string
     */
    public function getTypeName()
    {
        return self::getTypes()[$this->type];
    }

    /**
     * Check is type have many variants(select, multi-checkbox, color)
     * @return boolean
     */
    public function getIsTypeMulti()
    {
        if( $this->type == self::TYPE_MULTI_CHECKBOX ||
            $this->type == self::TYPE_SELECT  ||
            $this->type == self::TYPE_COLOR ) {
            return true;
        }
        return false;
    }

}
