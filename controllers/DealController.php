<?php

namespace app\controllers;

use app\models\Deal;
use app\models\ProductGoods;
use Yii;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * ProductController implements the CRUD actions for ProductGoods model.
 */
class DealController extends FrontController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
//                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Deals.
     * @return mixed
     */
    public function actionIndex()
    {
        $deals = new Deal();

        return $this->render('index', [
            'deals' => $deals,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionAjaxGetCategories()
    {

    }
}
