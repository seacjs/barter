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
 *
 * @property Profile[] $profiles
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
            'name' => 'Name',
            'slug' => 'Slug',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        $this->hasMany(Region::class, ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::class, ['city_id' => 'id']);
    }
}
