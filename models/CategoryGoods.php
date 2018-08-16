<?php

namespace app\models;

use Yii;
use seacjs\nestedsets\behaviors\NestedSetsBehavior;
use yii\db\Query;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $h1
 * @property int $left_key
 * @property int $right_key
 * @property int $level
 * @property string $content
 * @property int $active
 *
 * @property OptionBool[] $optionBools
 * @property OptionInteger[] $optionIntegers
 * @property OptionString[] $optionStrings
 */
class CategoryGoods extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            [
                'class' => NestedSetsBehavior::class,
                'leftAttribute' => 'left_key',
                'rightAttribute' => 'right_key',
                'levelAttribute' => 'level',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_goods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['left_key', 'right_key', 'level'], 'required'],
            [['left_key', 'right_key', 'level', 'active'], 'integer'],
            [['content'], 'string'],
            [['name', 'slug', 'title', 'description', 'keywords', 'h1'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'slug' => 'Слаг',
            'title' => 'Title',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'h1' => 'H1',
            'left_key' => 'Left Key',
            'right_key' => 'Right Key',
            'level' => 'Level',
            'content' => 'Контент',
            'active' => 'Активный',
        ];
    }

    public function getOptions()
    {
        return $this->hasMany(OptionGoods::class, ['category_id' => 'id']);

//        return (new Query())
//            ->from([
//                'option_g_bool',
//                'option_g_integer',
//                'option_g_string'
//            ])
//            ->where([
//                'category_id' => $this->id
//            ])->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptionBools()
    {
        return $this->hasMany(OptionGoodsBool::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptionIntegers()
    {
        return $this->hasMany(OptionGoodsInteger::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptionStrings()
    {
        return $this->hasMany(OptionGoodsString::className(), ['category_id' => 'id']);
    }
}
