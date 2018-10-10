<?php

namespace app\controllers;

use app\models\MoneyTransaction;
use app\models\test\Test;
use Yii;
use app\models\User;
use app\models\UserSearch;
use app\controllers\FrontController;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\debug\models\search\Profile;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends FrontController
{

//    public $layout = 'admin';

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
                        'actions' => ['index','view','update','users'],
                        'allow' => true,
                        'roles' => ['manager','admin','superAdmin'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = User::find()->where([
            'not in', 'user.id', Yii::$app->user->id
        ])->joinWith('profile')->orderBy('user.id DESC');

        $request = Yii::$app->request;
        if($request->isPost) {
            $post = $request->post('UserSearch');

            if(isset($post['city_id'])) {
                $query = $query->andWhere([
                    'profile.city_id' => $post['city_id']
                ]);
            }

            if(isset($post['name'])) {
                $query = $query->andWhere([
                    'like', 'user.username', $post['name']
                ]);
                $query = $query->orWhere([
                    'like', 'profile.name', $post['name']
                ]);
            }

//            todo: ages min and max
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTransaction($id)
    {
        $post = Yii::$app->request->post();

        $user = User::find()->where(['id' => $id])->one();
        $me =  Yii::$app->user->identity;

        $moneyTransaction = new MoneyTransaction();

        if($moneyTransaction->load($post)) {

            if($me->money >= $moneyTransaction->value) {
                $me->money = $me->money - $moneyTransaction->value;
                $user->money = $user->money + $moneyTransaction->value;
                $moneyTransaction->from_id = $me->id;
                $moneyTransaction->to_id = $id;
                $moneyTransaction->operation = $moneyTransaction::OPERATION_TRANSACTION;
                $moneyTransaction->save();
                $me->save();
                $user->save();
            } else {
                $moneyTransaction->addError('value','Недостаточно баллов');
            }

        }

        return $this->render('transaction', [
            'moneyTransaction' => $moneyTransaction,
            'user' => $user
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $password = Yii::$app->security->generateRandomString();
            $model->setPassword($password);
            $auth = Yii::$app->authManager;
            $role = $auth->getRole($model->role);
            $auth->assign($role, $model->id);

            if($model->sendEmailToUserWithData) {
                Yii::$app->mailer->compose(['html' => '@app/mail/newUserByAdmin'], [
                    'role' => $model->role,
                    'username' => $model->username,
                    'password' => $password,
                ])
                    ->setFrom(['dublbarter@gmail.com' => 'Dubl'])
                    ->setTo($model->email)
                    ->setSubject('Вы добавлены в качестве нового пользователя на сайт ' . Yii::$app->name)
                    ->send();
            }

            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->profile->load($post) && $model->validate() && $model->profile->validate()) {
            $model->save();
            $model->profile->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
