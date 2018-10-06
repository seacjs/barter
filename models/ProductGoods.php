<?php

namespace app\models;

use Yii;
use yii\base\DynamicModel;
use yii\behaviors\TimestampBehavior;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $content
 * @property int $category_id
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 * @property int $price
 * @property string $addressRadioButton
 *
 * @property Product $category
 * @property User $user
 * @property Product[] $products
 */
class ProductGoods extends ProductBase
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_goods';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany(OptionGoods::class, ['category_id' => 'category_id'])->with('optionVariantsArray');
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
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(ProductGoods::class, ['category_id' => 'category_id']);
    }


    private $optionModel = null;
    /**
     * Generate and return optionModel
     * @return DynamicModel
     * */
    public function getOptionModel()
    {
        if($this->optionModel === null) {
            $fields = [];
            foreach($this->options as $option) {
                $fields[] = 'option'.$option->id.'';
            }
            $this->optionModel =  new DynamicModel($fields);
            foreach($this->options as $option) {

                if($option->type === $option::TYPE_MULTI_CHECKBOX) {
                    $optionValueGoods = OptionValueGoods::find()->where([
                        'product_id' => $this->id,
                        'option_id' => $option->id
                    ])->all();
                    // VarDumper::dump($optionValueGoods,10,1);die;
                    $list = [];
                    foreach($optionValueGoods as $optionValueGoodsItem) {
                        $list[] = $optionValueGoodsItem->value;
                    }
                    $this->optionModel['option' . $option->id] = $list;

                } else {
                    $optionValueGoods = OptionValueGoods::find()->where([
                        'product_id' => $this->id,
                        'option_id' => $option->id
                    ])->one();
                    $this->optionModel['option'.$option->id] = $optionValueGoods == null ? null : $optionValueGoods->value;
                }

                $this->optionModel->addRule(['option'.$option->id.''], 'safe');
            }
        }

        return $this->optionModel;
    }

    /**
     * Save options of this model OptionValueGoods
     * todo: add required rules
     * @return boolean
     * */
    public function saveOptions()
    {
        foreach($this->options as $option) {

            if($option->type === $option::TYPE_MULTI_CHECKBOX) {
                OptionValueGoods::deleteAll([
                    'option_id' => $option->id,
                    'product_id' => $this->id
                ]);
                VarDumper::dump($this->optionModel['option'.$option->id.''],10,1);
                foreach($this->optionModel['option'.$option->id.''] as $optionMulti) {
                    $optionValueGoods = new OptionValueGoods();
                    $optionValueGoods->product_id = $this->id;
                    $optionValueGoods->option_id = $option->id;
                    $optionValueGoods->value = $optionMulti;
                    $optionValueGoods->save();
                }

            } else {
                $optionValueGoods = OptionValueGoods::findOne([
                    'product_id' => $this->id,
                    'option_id' => $option->id,
                ]);
                if($optionValueGoods == null) {
                    $optionValueGoods = new OptionValueGoods();
                }
                $optionValueGoods->product_id = $this->id;
                $optionValueGoods->option_id = $option->id;
                $optionValueGoods->value = $this->optionModel['option' . $option->id . ''];
                $optionValueGoods->save();
            }

        }

        return true;
    }

}
