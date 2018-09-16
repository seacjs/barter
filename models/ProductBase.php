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
class ProductBase extends \yii\db\ActiveRecord
{

    /*
     * todo: Добавить таблицу которая бы сохраняла старые значения, и модератор видел бы что изменилось в случае с STATUS_UPDATED
     * */

    const STATUS_DRAFT = 0;
    const STATUS_NEW = 1;
    const STATUS_REJECTED= 2;
    const STATUS_UPDATED = 3;
    const STATUS_ACTIVE = 10;

    public static function statuses()
    {
        return [
            self::STATUS_DRAFT => 'черновик',
            self::STATUS_NEW => 'на модерации',
            self::STATUS_REJECTED => 'отклонен',
            self::STATUS_UPDATED => 'на повторной модерации',
            self::STATUS_ACTIVE => 'активный',
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
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['category_id','price'], 'integer'],
            [['category_id'], 'required'],
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
            'name' => 'Название',
            'slug' => 'Слаг',
            'content' => 'Контент',
            'category_id' => 'Категория',
            'user_id' => 'Пользователь',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
            'status' => 'Статус',
            'price' => 'Цена',
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
        return $this->hasMany(ProductGoods::class, ['category_id' => 'id']);
    }
}
