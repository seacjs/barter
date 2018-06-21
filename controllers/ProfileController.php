<?php

namespace app\controllers;

use app\models\User;
use Yii;
use app\models\Profile;


class ProfileController extends FrontController
{

    public function actionIndex()
    {
        $model = Yii::$app->user->identity->profile;
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
        if($model->load($post) && $model->validate()) {

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

}