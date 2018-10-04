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

    const OPERATION_ADD_MONEY_TO_USER = 4;
    const OPERATION_REMOVE_MONEY_FROM_USER = 5;


    /**
     * Return operation list
     * */
    public function getOperationList()
    {
        return [
            self::OPERATION_ADD_MONEY => 'Добавить баллов в систему',
            self::OPERATION_REMOVE_MONEY => 'Убрать баллы из системы',
            self::OPERATION_ADD_PERCENT => 'Увеличить процент балловой массы',
            self::OPERATION_REMOVE_PERCENT  => 'Уменьшить процент балловой массы',
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

        /* todo: add db transaction */

        switch ($this->operation) {
            case self::OPERATION_ADD_MONEY:
                $this->value = $this->value + intval($this->shift);
                $this->total = $this->total + intval($this->shift);
                break;
            case self::OPERATION_REMOVE_MONEY:
                if($this->value > $this->shift) $this->shift = $this->value;
                $this->value = $this->value - intval($this->shift);
                $this->total = $this->total - intval($this->shift);
                break;
            case self::OPERATION_ADD_PERCENT:
                /**
                 * Add for each user money and then remove sum from total counter
                 * */
                $sumShift = 0;
                /* todo: only with role noAdmin */
                $users = User::find()->all();
                foreach($users as $user) {
                    $userShift = $user->money / 100 * $this->shift;
                    $intvalUserShift = intval($userShift);
                    if($intvalUserShift < 0 ) $intvalUserShift = 0;
                    $sumShift += $intvalUserShift;

                    $user->money = $user->money + $intvalUserShift;
                    $user->save();
                    $moneyTransaction = new MoneyTransaction([
                        'from_id' => $user->id,
                        'to_id' => null,
                        'operation' => self::OPERATION_REMOVE_PERCENT,
                        'message' => $this->message,
                        'status' => MoneyTransaction::STATUS_SUCCESS,
                        'value' => $intvalUserShift
                    ]);
                    $moneyTransaction->save();
                }

                $this->total = $this->total + $sumShift;
                break;
            case self::OPERATION_REMOVE_PERCENT:
                /**
                 * Remove for each user money and then remove sum from total counter
                 * */
                $sumShift = 0;
                /* todo: only with role noAdmin */
                $users = User::find()->all();
                foreach($users as $user) {
                    $userShift = $user->money / 100 * $this->shift;
                    $intvalUserShift = intval($userShift);
                    if($intvalUserShift < 0 ) $intvalUserShift = 0;
                    $sumShift += $intvalUserShift;

                    $user->money = $user->money - $intvalUserShift;
                    $user->save();
                    $moneyTransaction = new MoneyTransaction([
                        'from_id' => $user->id,
                        'to_id' => null,
                        'operation' => self::OPERATION_REMOVE_PERCENT,
                        'message' => $this->message,
                        'status' => MoneyTransaction::STATUS_SUCCESS,
                        'value' => $intvalUserShift
                    ]);
                    $moneyTransaction->save();
                }

                $this->total = $this->total - $sumShift;
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
