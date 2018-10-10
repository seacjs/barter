<?php

namespace app\controllers;


use app\models\Deal;
use app\models\MoneyTransaction;
use app\models\ProductGoods;
use app\models\User;
use yii\helpers\VarDumper;

class MarketController extends FrontController
{

    public function actionIndex()
    {

        return $this->render('index', [

        ]);
    }

    /*
     *
     * @param $id app\models\ProductGoods
     */
    public function actionBuy($id)
    {
        $product = ProductGoods::findOne($id);
        $userBuyer = \Yii::$app->user->identity;
        $userSeller = $product->user;
        if($product->price <= $userBuyer->money) {

            $moneyTransaction = new MoneyTransaction([
                'value' => $product->price,
                'from_id' => $userBuyer->id,
                'to_id' => $userSeller->id,
                'user_id' => null,
                'operation' => MoneyTransaction::OPERATION_DEAL,
                'status' => MoneyTransaction::STATUS_HOLD,
            ]);
            $userBuyer->money = $userBuyer->money - $product->price;
            $userBuyer->save();
            $moneyTransaction->save();
            $deal = new Deal([
                'product_type' => Deal::TYPE_PRODUCT,
                'product_id' => $id,
                'transaction_id' => $moneyTransaction->id,
                'status' => Deal::STATUS_WAITING,
            ]);
            $deal->save();
            // $createMessage for seller

            $this->redirect('/market/import');

        } else {
            $this->goBack();
        }
    }

    /*
     *
     * @param $id app\models\Deal
     */
    public function actionConfirm($id)
    {
        $deal = Deal::findOne($id);
        $moneyTransaction = MoneyTransaction::findOne($deal->transaction_id);

        if(\Yii::$app->user->id != $moneyTransaction->from_id) {
            die();
        }
        $userSeller = User::findOne($moneyTransaction->to_id);
        $userSeller->money = $userSeller->money + $moneyTransaction->value;
        $moneyTransaction->load(['MoneyTransaction' => [
            'operation' => MoneyTransaction::OPERATION_DEAL,
            'status' => MoneyTransaction::STATUS_SUCCESS,
        ]]);

        $deal->load(['Deal' => [
            'status' => Deal::STATUS_SUCCESS,
        ]]);

        $userSeller->save();
        $moneyTransaction->save();
        $deal->save();

        $this->redirect('/market/import');
    }

    public function actionImport()
    {
        $deals = Deal::find()->where([
            'money_transaction.from_id' => \Yii::$app->user->id
        ])->andWhere([
            'deal.status' => Deal::STATUS_WAITING
        ])->joinWith('transaction')->all();

        $dealsArchive = Deal::find()->where([
            'money_transaction.from_id' => \Yii::$app->user->id
        ])->andWhere([
            'deal.status' => Deal::STATUS_SUCCESS
        ])->joinWith('transaction')->all();

        return $this->render('import', [
            'deals' => $deals,
            'dealsArchive' => $dealsArchive
        ]);
    }

    public function actionExport()
    {
        $deals = Deal::find()->where([
            'money_transaction.to_id' => \Yii::$app->user->id
        ])->andWhere([
            'deal.status' => Deal::STATUS_WAITING
        ])->joinWith('transaction')->all();

        $dealsArchive = Deal::find()->where([
            'money_transaction.to_id' => \Yii::$app->user->id
        ])->andWhere([
            'deal.status' => Deal::STATUS_SUCCESS
        ])->joinWith('transaction')->all();

        return $this->render('export', [
            'deals' => $deals,
            'dealsArchive' => $dealsArchive
        ]);
    }

}