<?php

namespace app\controllers;


use app\actions\FileDeleteAction;
use app\actions\FileSortAction;
use app\actions\FileUploadAction;
use app\actions\FileUploadCkeAction;
use app\models\File;
use app\models\OptionValueGoods;
use app\models\Product;
use app\models\ProductGoods;
use app\models\Profile;
use app\models\User;
use Yii;
use app\models\ProductSearch;
use app\controllers\FrontController;
use yii\base\DynamicModel;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

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

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'file-upload-cke' => [
                'class' => FileUploadCkeAction::class,
                'modelName' => ProductGoods::class,
            ],
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

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
//        $searchModel = new ProductSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $products = ProductGoods::find()
//            ->where([
//            'status' => ProductGoods::STATUS_ACTIVE
//        ])
            ->andWhere([
            'like','name',Yii::$app->request->post('name','')
        ])->all();

        return $this->render('index', [
            'products' => $products,
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
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
        $this->layout = 'full-width';
        $model = $this->findModel($id);
        $user = User::find()->with('profile')->where(['id' => $model->id])->one();
        return $this->render('view', [
            'model' => $model,
            'user' => $user,
            'profile' => $user->profile
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

            if($model->addressRadioButton == 'my') {
                $model->address = '';
            } else {
                $model->address = $post['ProductGoods']['address'];
            }
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

        $fileModel = new File();
        $fileModel->multiple = true;
        $fileModel->files = $model->files;

        if ($model->load($post) && (!isset($post['DynamicModel']) || $model->optionModel->load($post)) && $model->save() && $model->saveOptions()) {
//            return $this->redirect(['view', 'id' => $model->id]);

            if($model->addressRadioButton == 'my') {
                $model->address = '';
            } else {
                $model->address = $post['ProductGoods']['address'];
            }
            $model->save();

            return $this->redirect(['/profile/products']);
        }

        return $this->render('update', [
            'optionModel' => $optionModel,
            'model' => $model,
            'fileModel' => $fileModel,
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

    public function actionAjaxGetCategories() {
        $id = Yii::$app->request->post('id', null);
        $modelId = Yii::$app->request->post('modelId', null);
        Yii::$app->response->format = Response::FORMAT_JSON;
        $items = \app\models\CategoryGoods::find()
            ->select(['name','id'])
            ->indexBy('id');
        if($id !== null) {
            $parentCategory = \app\models\CategoryGoods::find()->where(['id' => $id])->one();
            $items = $items->where([
                '>','left_key', $parentCategory->left_key
            ])->andWhere([
                '<','right_key', $parentCategory->right_key
            ])->andWhere([
                'level' => intval($parentCategory->level) + 1
            ]);
            $items = $items->column();

            if(!empty($items)) {
                return $this->renderAjax('/product/_select', [
                    'level' => Yii::$app->request->post('level', 1),
                    'modelName' => 'ProductGoods',
                    'attributeName' => 'category_id',
                    'items' => $items,
                ]);
            }
        }
        return '';
    }
}
