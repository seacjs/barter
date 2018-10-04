<?php

namespace app\controllers;

use app\models\Message;
use Yii;
use app\models\User;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Response;

class MessagesController extends FrontController
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index','view','ajaxCountNewMessage'],
                'rules' => [
                    [
                        'actions' => ['index','view','ajaxCountNewMessage'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        /* todo: add dialogs table */
        $dialogs = (new Query())
            ->select(Message::tableName().'.from, '.Message::tableName().'.to')
            ->from(Message::tableName())
            ->where([Message::tableName().'.from' => Yii::$app->user->identity->id])
            ->orWhere([Message::tableName().'.to' => Yii::$app->user->identity->id])
            ->orderBy([Message::tableName().'.id' => SORT_DESC])
            ->all();

        $users_ids = [];
        foreach($dialogs as $key => $dialog) {
            $users_ids[] = $dialog['from'];
            $users_ids[] = $dialog['to'];
        }

        $users_ids = array_unique($users_ids);
        $value_to_delete = Yii::$app->user->id;
        $users_ids = array_flip($users_ids);
        $users_ids_with_me = $users_ids;
        unset($users_ids[$value_to_delete]);
        $users_ids = array_flip($users_ids);
        $users_ids_with_me = array_flip($users_ids_with_me);
        $dialogs = [];

        /* todo: with images */
        $users = User::Find()
            ->where(['in', 'id', $users_ids_with_me])
            ->indexBy('id')
            ->all();
//        VarDumper::dump($users,10,1);die;


        foreach($users_ids as $key => $user_id) {

            $message = (new Query())
                ->from(Message::tableName())
                ->where([
                    'from' => $user_id,
                    'to' => Yii::$app->user->identity->id
                ])
                ->orWhere([
                    'to' => $user_id,
                    'from' => Yii::$app->user->identity->id
                ])
                ->orderBy([Message::tableName().'.id' => SORT_DESC])
                ->one();

            $dialogs[] = $message;

        }



        return $this->render('index', [
            'user' => Yii::$app->user->identity,
            'users' => $users,
            'dialogs' => $dialogs
        ]);
    }

    public function actionView($id)
    {
        $this->view->registerAssetBundle('app\assets\ChatAsset');
        /* todo: add this layout */
//        $this->layout = 'messages';
        $messages = Message::find()
            ->where([
                'to' => Yii::$app->user->id,
                'from' => $id
            ])
            ->orWhere([
                'to' => $id,
                'from' => Yii::$app->user->id
            ])
            ->orderBy(['id' => SORT_ASC])
            ->limit(50)
            ->all();

        $user = User::findOne($id);

        return $this->render('view', [
            'user' => $user,
            'messages' => $messages
        ]);
    }

    public function actionAjaxCountNewMessage()
    {
        /* todo: add access filter to this controller */
        Yii::$app->response->format = Response::FORMAT_JSON;
        $messages = count(Message::find()
            ->where([
                'to' => Yii::$app->user->id,
                'status' => Message::STATUS_NEW
            ])->andWhere([
                'not in', 'from', [Yii::$app->user->id]
            ])
            ->indexBy('from')
            ->asArray()
            ->all());
        return json_encode($messages);
    }

}