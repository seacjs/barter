<?php

namespace app\modules\admin\controllers;

use app\models\MoneyTransaction;
use app\models\SystemMoney;
use app\models\SystemMoneyLog;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegionController implements the CRUD actions for Region model.
 */
class MoneyController extends FrontController
{

    public $layout = 'admin';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index','create','view','update','delete'],
                'rules' => [
                    [
                        'actions' => ['index','create','view','update','delete'],
                        'allow' => true,
                        /* todo: remove admin role access */
                        'roles' => ['admin','superAdmin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all
     * @return mixed
     */
    public function actionIndex()
    {
        $systemMoney = SystemMoney::find()->one();
        $post = Yii::$app->request->post();

        if($systemMoney->load($post) && $systemMoney->validate()) {
            $systemMoney->applyOperation();
        }

        $moneyTransaction = new MoneyTransaction();

        if($moneyTransaction->load($post)) {

            $user = User::find()->where(['id' => $moneyTransaction->user_id])->one();

            if($moneyTransaction->operation == $moneyTransaction::OPERATION_ADD_MONEY_TO_USER) {
                if($systemMoney->value > $moneyTransaction->value) {
                    $moneyTransaction->to_id = $moneyTransaction->user_id;
                    $moneyTransaction->from_id = null;
                    $user->money = $user->money + $moneyTransaction->value;
                    $systemMoney->value = $systemMoney->value - $moneyTransaction->value;
                } else {
                    $moneyTransaction->addError('value','В системе не достаточно баллов. Доступных баллов '. $systemMoney->value);
                }
            } else {
                if($user->money > $moneyTransaction->value) {
                    $moneyTransaction->to_id = null;
                    $moneyTransaction->from_id = $moneyTransaction->user_id;
                    $user->money = $user->money - $moneyTransaction->value;
                    $systemMoney->value = $systemMoney->value + $moneyTransaction->value;
                } else {
                    $moneyTransaction->addError('value','У пользователя всего '. $user->money . ' баллов');
                }
            }

            if(!$moneyTransaction->hasErrors()) {
                $moneyTransaction->save();
                $user->save();
                $systemMoney->save();
            }

        }

        $systemMoneyLog = SystemMoneyLog::find()->limit(10)->orderBy(['id' => SORT_DESC])->all();

        return $this->render('index', [
            'money' => \app\models\SystemMoney::find()->one(),
            'systemMoney' => $systemMoney,
            'systemMoneyLog' => $systemMoneyLog,
            'moneyTransaction' => $moneyTransaction,
        ]);
    }

}
