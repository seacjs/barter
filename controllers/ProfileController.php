<?php

namespace app\controllers;

use app\models\Product;
use app\models\ProductGoods;
use app\models\User;
use Yii;
use app\models\Profile;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;


class ProfileController extends FrontController
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index','view','update','users'],
                'rules' => [
                    [
                        'actions' => ['index','view','update','users'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = Yii::$app->user->identity->profile;
        return $this->redirect('/profile/update');
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionView($id = null)
    {
        if($id == null) {
            $model = Yii::$app->user->identity->profile;
        } else {
            $model = Profile::findOne($id);
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id = null)
    {
        $post = Yii::$app->request->post();

        if($id == null) {
            $user = Yii::$app->user->identity;
        } else {
            $user = User::findOne($id);
        }

        $model = $user->profile;
        if($model->load($post) && $model->user->load($post) && $model->validate() && $model->user->validate()) {
            $model->save();
            $model->user->save();
        }
//        VarDumper::dump($model,10,1);die;

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionProducts()
    {
        $products = ProductGoods::find()->where([
            'user_id' => Yii::$app->user->id
        ])->all();

        return $this->render('products', [
            'products' => $products,
        ]);
    }

}