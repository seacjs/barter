<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
 *
 * @property Product $category
 * @property User $user
 * @property Product[] $products
 */
class ProductService extends \yii\db\ActiveRecord
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
        return 'product_service';
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(CategoryService::class, ['id' => 'category_id']);
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
        return $this->hasMany(ProductService::class, ['category_id' => 'category_id']);
    }
}
