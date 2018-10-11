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
class Product extends \yii\db\ActiveRecord
{

    const STATUS_DRAFT = 0;
    const STATUS_NEW = 1;
    const STATUS_REJECTED= 2;
    const STATUS_UPDATED = 3;
    const STATUS_ACTIVE = 10;

    public static function statuses()
    {
        return [
            self::STATUS_DRAFT => 'черновик',
            self::STATUS_DRAFT => 'на модерации',
            self::STATUS_DRAFT => 'отклонен',
            self::STATUS_DRAFT => 'к повторной модерации',
            self::STATUS_DRAFT => 'активный',
        ];
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
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content','video'], 'string'],
            [['category_id'], 'integer'],
            [['created_at', 'updated_at','status'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 255],
//            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'slug' => 'Slug',
            'content' => 'Content',
            'category_id' => 'Category ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'video' => 'Video',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
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
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }
}
