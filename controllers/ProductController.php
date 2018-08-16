<?php

namespace app\controllers;

use app\models\OptionValueGoods;
use app\models\ProductGoods;
use app\models\Profile;
use Yii;
use app\models\ProductSearch;
use app\controllers\FrontController;
use yii\base\DynamicModel;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for ProductGoods model.
 */
class ProductController extends FrontController
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $products = ProductGoods::find()->where(['status' => ProductGoods::STATUS_ACTIVE])->all();

        return $this->render('index', [
            'products' => $products,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all new Product models or updated for moderation.
     * @return mixed
     */
    public function actionModerate()
    {
        $products = ProductGoods::find()->where([
            'status' => ProductGoods::STATUS_NEW
        ])->orWhere([
            'status' => ProductGoods::STATUS_UPDATED
        ])->all();

        return $this->render('index', [
            'products' => $products,
        ]);
    }


    /**
     * Activate a new Product model by admin.
     * @return mixed
     */
    public function actionActivate($id)
    {
        $model = $this->findModel($id);
        $model->status = $model::STATUS_ACTIVE;
        $model->save();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductGoods();
        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->validate()) {

            $model->status = ProductGoods::STATUS_NEW;
            $model->user_id = Yii::$app->user->id;
            $model->save();

            return $this->redirect(['update', 'id' => $model->id]);
//            return $this->redirect(['/profile/products']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $post = Yii::$app->request->post();

        $optionModel = $model->optionModel;

//        $dump = OptionValueGoods::find()->where([
//            'product_id' => $id,
//        ])->all();
//        VarDumper::dump($optionModel->load($post),10,1);die;

        if ($model->load($post) && (!isset($post['DynamicModel']) || $model->optionModel->load($post)) && $model->save() && $model->saveOptions()) {
//            return $this->redirect(['view', 'id' => $model->id]);

            return $this->redirect(['/profile/products']);
        }

        return $this->render('update', [
            'optionModel' => $optionModel,
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductGoods::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
