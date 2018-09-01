<?php

namespace app\modules\admin\controllers;

use app\models\SystemMoney;
use app\models\SystemMoneyLog;
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
//        VarDumper::dump($systemMoney,10,1);die;

        $systemMoneyLog = SystemMoneyLog::find()->limit(10)->orderBy(['id' => SORT_DESC])->all();

        return $this->render('index', [
            'money' => \app\models\SystemMoney::find()->one(),
            'systemMoney' => $systemMoney,
            'systemMoneyLog' => $systemMoneyLog,
        ]);
    }

}
