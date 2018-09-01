<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "system_money".
 *
 * @property int $value
 */
class SystemMoney extends \yii\db\ActiveRecord
{

    public static function primaryKey()
    {
        return ['value'];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'system_money';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value', 'shift', 'operation', 'total'], 'integer'],
            [['message'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'shift' => 'Выберите колечество',
            'operation' => 'Выберите операцию',
            'message' => 'Комментарий',
            'value' => 'Value',
            'total' => 'Total'
        ];
    }

    public $shift;
    public $operation;
    public $message;

    const OPERATION_ADD_MONEY = 0;
    const OPERATION_REMOVE_MONEY = 1;
    const OPERATION_ADD_PERCENT = 2;
    const OPERATION_REMOVE_PERCENT = 3;

    /**
     * Return operation list
     * */
    public function getOperationList()
    {
        return [
            self::OPERATION_ADD_MONEY => 'Добавить баллов в систему',
            self::OPERATION_REMOVE_MONEY => 'Убрать баллы из системы',
            self::OPERATION_ADD_PERCENT => 'Добавить процент баллов в систему',
            self::OPERATION_REMOVE_PERCENT  => 'Убрать процент баллов из системы',
        ];
    }


    /**
     * Apply operation with money points
     *
     * TODO:: ADD DATABASE TRANSACTION THEN ADDED MONEYS
     * 1. добавить баллы в систему
     * 2. Изменить процент баллов в системе. +/-
     * 3. Добавить баллы администратору из системы
     *
     * */
    public function applyOperation()
    {

        /* start db-transaction */

        switch ($this->operation) {
            case self::OPERATION_ADD_MONEY:
                $this->value = $this->value + intval($this->shift);
                $this->total = $this->total + intval($this->shift);
                break;
            case self::OPERATION_REMOVE_MONEY:
                $this->value = $this->value - intval($this->shift);
                $this->total = $this->total - intval($this->shift);
                break;
            case self::OPERATION_ADD_PERCENT:
                $this->value = $this->value + intval($this->shift);
                $this->total = $this->total + intval($this->shift);
                break;
            case self::OPERATION_REMOVE_PERCENT:
                $this->value = $this->value - intval($this->shift);
                $this->total = $this->total - intval($this->shift);
                break;
        }

        $this->save();

        $this->addLog();
        /* end db-transaction */

        if(!$this->hasErrors()) {
            $this->shift = null;
            $this->operation = null;
            $this->message = null;
        }

        return true;
    }

    /**
     * Add log about main system money operation
     */
    public function addLog()
    {
        $systemMoneyLog = new SystemMoneyLog([
            'user_id' => Yii::$app->user->id,
            'message' => $this->message,
            'value' => $this->shift,
            'operation' => $this->operation,
        ]);
        $systemMoneyLog->save();
    }


}
