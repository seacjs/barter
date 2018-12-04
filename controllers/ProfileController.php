<?php

namespace app\controllers;

use app\actions\FileDeleteAction;
use app\actions\FileSortAction;
use app\actions\FileUploadAction;
use app\models\File;
use app\models\FileCrutch;
use app\models\MoneyTransaction;
use app\models\Product;
use app\models\ProductGoods;
use app\models\User;
use Yii;
use app\models\Profile;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Response;


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
    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'file-upload' => [
                'class' => FileUploadAction::class,
                'modelName' => ProductGoods::class,
            ],
            'file-delete' => [
                'class' => FileDeleteAction::class,
                'modelName' => ProductGoods::class,
            ],
            'file-sort' => [
                'class' => FileSortAction::class,
                'modelName' => ProductGoods::class,
            ],
        ]);
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

        $fileModel = new File();
        $fileModel->multiple = false;
        $fileModel->files = $user->files;

        if($model->load($post) && $model->user->load($post) && $model->validate() && $model->user->validate()) {
            $model->save();
            $model->user->save();
        }
//        VarDumper::dump($model,10,1);die;

        return $this->render('update', [
            'model' => $model,
            'fileModel' => $fileModel
        ]);
    }

    public function actionAvatar($id = null)
    {

        if($id == null) {
            $user = Yii::$app->user->identity;
        } else {
            $user = User::findOne($id);
        }
        $model = $user->profile;

        $post = Yii::$app->request->post();

//            VarDumper::dump($post,10,1);die;


        $fileModel = new File();
        $fileModel->multiple = false;
//        $fileModel->files = $user->files;



        return $this->render('avatar', [
            'user' => $user,
            'fileModel' => $fileModel
        ]);
    }

    public function actionUploadAvatar()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;


        return json_encode('111');
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
    public function actionTransactions()
    {
        $outcomeTransactions = MoneyTransaction::find()
            ->where([
                'operation' => MoneyTransaction::OPERATION_TRANSACTION
            ])
            ->andWhere([
                'from_id' => Yii::$app->user->id
            ])
            ->with('userTo')->all();


        $incomeTransactions = MoneyTransaction::find()
            ->where([
                'operation' => MoneyTransaction::OPERATION_TRANSACTION
            ])
            ->andWhere([
                'to_id' => Yii::$app->user->id
            ])
            ->with('userFrom')->all();

        return $this->render('transactions', [
            'outcomeTransactions' => $outcomeTransactions,
            'incomeTransactions' => $incomeTransactions,
        ]);
    }

}