<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "message_ignorelist".
 *
 * @property int $user_id
 * @property int $blocks_user_id
 * @property int $created_at
 */
class MessageIgnorelist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message_ignorelist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'blocks_user_id', 'created_at'], 'required'],
            [['user_id', 'blocks_user_id', 'created_at'], 'integer'],
            [['user_id', 'blocks_user_id'], 'unique', 'targetAttribute' => ['user_id', 'blocks_user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'blocks_user_id' => 'Blocks User ID',
            'created_at' => 'Created At',
        ];
    }
}
