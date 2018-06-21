<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property int $created_at
 * @property string $message
 * @property int $from
 * @property int $to
 * @property int $status
 */
class Message extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_NEW = 1;
    const STATUS_READ = 10;

    private $_userFrom = null;
    private $_userTo = null;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'required'],
            [['created_at', 'from', 'to', 'status'], 'integer'],
            [['message'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'message' => 'Message',
            'from' => 'From',
            'to' => 'To',
            'status' => 'Status',
        ];
    }

    public static function send($from, $to, $message) {


    }

    public function setUserFrom($userModel) {
        $this->_userFrom = $userModel;
    }
    public function setUserTo($userModel) {
        $this->_userTo = $userModel;
    }

    public function getUserFrom() {
        if($this->_userFrom === null) {
            return $this->hasOne(User::class, ['id' => 'from']);
            //$this->_userFrom = User::findOne($this->from);
        }
        return $this->_userFrom;
    }
    public function getUserTo() {
        if($this->_userTo === null) {
            return $this->hasOne(User::class, ['id' => 'to']);
            //$this->_userTo = User::findOne($this->to);
        }
        return $this->_userTo;
    }
}
