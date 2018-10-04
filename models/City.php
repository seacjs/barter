<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * TODO:: rebuild this model
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property integer $region_id
 *
 * @property Profile[] $profiles
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id'], 'integer'],
            [['name', 'slug'], 'string'],
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
            'region_id' => 'Регион',
            'slug' => 'Slug',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        $this->hasOne(City::class, ['region_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::class, ['city_id' => 'id']);
    }
}
