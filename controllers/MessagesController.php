<?php

namespace app\controllers;

use app\models\Message;
use Yii;
use app\models\User;
use yii\db\Query;
use yii\web\Response;

class MessagesController extends FrontController
{

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
        unset($users_ids[$value_to_delete]);
        $users_ids = array_flip($users_ids);
        $dialogs = [];

        /* todo: with images */
        $users = User::Find()
            ->where(['in', 'id', $users_ids])
            ->indexBy('id')
            ->all();

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
            'user' => Yii::$app->user->identity->id,
            'users' => $users,
            'dialogs' => $dialogs
        ]);
    }

    public function actionView($id)
    {
        $this->view->registerAssetBundle('app\assets\ChatAsset');
        /* todo: add this layout */
//        $this->layout = 'messages';
        $messages = [];
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
        return json_encode(
            Message::find()->where([
                'to' => Yii::$app->user->id
            ])->count()
        );
    }

}