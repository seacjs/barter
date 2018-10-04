<?php

namespace app\modules\admin\controllers;

use app\models\CategoryService;
use Yii;
use app\models\Category;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryServiceController extends FrontController
{

    public $layout = 'admin';

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
                'modelClassName' => CategoryService::class,
//                'modelClass' => new Category(),
            ],
            'nested-sets-insert-before' => [
                'class' => \seacjs\nestedsets\components\NestedSetsInsertBeforeAction::class,
                'modelClassName' => CategoryService::class,
            ],
            'nested-sets-insert-after' => [
                'class' => \seacjs\nestedsets\components\NestedSetsInsertAfterAction::class,
                'modelClassName' => CategoryService::class,
            ],
            'nested-sets-insert-over' => [
                'class' => \seacjs\nestedsets\components\NestedSetsInsertOverAction::class,
                'modelClassName' => CategoryService::class,
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

        $categories = (new CategoryService())->makeTree(CategoryService::find()->orderBy('left_key')->all());

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
        $model = new CategoryService();

        if ($model->load(Yii::$app->request->post())) {

            if($id === null) {
                $model->createNode();
            } else {
                $parent = CategoryService::findOne(['id' => $id]);
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
     * Finds the CategoryService model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CategoryService the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CategoryService::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
