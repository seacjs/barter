<?php

namespace app\modules\admin\controllers;

use app\models\CategoryGoods;
use app\models\OptionGoods;
use app\models\OptionVariantGoods;
use Yii;
use app\models\Category;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryGoodsController extends FrontController
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'nested-sets-change' => [
                'class' => \seacjs\nestedsets\components\NestedSetsChangeAction::class,
                'modelClassName' => CategoryGoods::class,
//                'modelClass' => new Category(),
            ],
            'nested-sets-insert-before' => [
                'class' => \seacjs\nestedsets\components\NestedSetsInsertBeforeAction::class,
                'modelClassName' => CategoryGoods::class,
            ],
            'nested-sets-insert-after' => [
                'class' => \seacjs\nestedsets\components\NestedSetsInsertAfterAction::class,
                'modelClassName' => CategoryGoods::class,
            ],
            'nested-sets-insert-over' => [
                'class' => \seacjs\nestedsets\components\NestedSetsInsertOverAction::class,
                'modelClassName' => CategoryGoods::class,
            ],
        ];
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
//        $modelClassName = Category::class;
//        VarDumper::dump(Category::deleteAll(),10,1);die;

//        Category::deleteAll([]);
//        foreach([
//                    ['name' => 'Авто', 'slug' => 'auto'],
//                    ['name' => 'Музыкальные инструменты', 'slug' => 'music'],
//                    ['name' => 'Товары для дома', 'slug' => 'home'],
//                ] as $item) {
//            $cat = new Category();
//            $cat->name = $item['name'];
//            $cat->slug = $item['slug'];
//            $cat->createNode();
//        }

//        VarDumper::dump(Category::find()->select(['left_key','right_key','id','name'])->asArray()->orderBy('id')->all(),10,1);
//        die;

        $categories = (new CategoryGoods())->makeTree(CategoryGoods::find()->orderBy('left_key')->all());

        return $this->render('index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = null)
    {
        $model = new CategoryGoods();

        if ($model->load(Yii::$app->request->post())) {

            if($id === null) {
                $model->createNode();
            } else {
                $parent = CategoryGoods::findOne(['id' => $id]);
                $model->appendToNode($parent);
            }

            if($model->save()) {
                return $this->redirect(['update', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->removeNode();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CategoryGoods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CategoryGoods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CategoryGoods::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Add a new Option model to Category model.
     * If creation is successful, the browser will be redirected to the 'view' page of Category.
     * @return mixed
     */
    public function actionAddOption($id)
    {
        $model = new OptionGoods();
        $categoryModel = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update-option', 'id' => $model->id]);
        }
        return $this->render('_options', [
            'categoryModel' => $categoryModel,
            'model' => $model,
        ]);
    }
    public function actionUpdateOption($id) {
        $model = $this->findOptionModel($id);
        $categoryModel = $this->findModel($model->category_id);
        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->save() &&
            (isset($post['OptionVariantGoods']['value']) ? $this->actionProcessVariants($model->id, $post['OptionVariantGoods']['value']) : true )) {
            return $this->redirect(['view', 'id' => $categoryModel->id]);
        }
        return $this->render('_options', [
            'categoryModel' => $categoryModel,
            'model' => $model,
        ]);
    }
    public function actionDeleteOption($id) {
        OptionVariantGoods::deleteAll([
            'option_id' => $id
        ]);
        $model = $this->findOptionModel($id);
        $category_id = $model->category->id;
        $model->delete();
        return $this->redirect(['view', 'id' => $category_id]);
    }
    protected function findOptionModel($id){
        if (($model = OptionGoods::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /************************************************************
     *
     * Process methods
     *
     * **********************************************************/

    /**
     * Remove all old variants and add a new variant option
     * AJAX action
     * @param integer $optionId - option primary key
     * @param array $variantValues - array of variants
     * @return bool
     */
    public function actionProcessVariants($optionId, $variantValues) {
        OptionVariantGoods::deleteAll([
            'option_id' => $optionId
        ]);
        foreach($variantValues as $variantValue){
            Yii::$app->response->format = Response::FORMAT_JSON;
            $optionVariantGoods = new OptionVariantGoods();
            $optionVariantGoods->option_id = intval($optionId);
            /* todo::remove from model name or value */
            $optionVariantGoods->name = $variantValue;
            $optionVariantGoods->value = $variantValue;
            $optionVariantGoods->save();

        }
        return true;
    }

    /************************************************************
     *
     *      AJAX methods
     *
     * **********************************************************/

    /**
     * Generate view for option form, add one new option variant
     * AJAX action
     * @param integer $id - serial number option variant
     * @return view option variant element form
     */
    public function actionAjaxAddVariant($id) {

        $optionVariantGoods = new OptionVariantGoods();
        $form = new ActiveForm();
        $optionModel = OptionGoods::findOne(['id' => intval(Yii::$app->request->get('optionGoodsId'))]);

        return $this->renderPartial('_optionVariant',[
            'key' => $id,
            'model' => $optionVariantGoods,
            'form' => $form,
            'optionModel' => $optionModel
        ]);
    }
}
