<?php

namespace app\controllers;



use app\models\News;

class NewsController extends FrontController
{

    public function actionIndex()
    {

        return $this->render('index', [
            'news' => News::find()->where(['active' => 1])->orderBy(['id' => SORT_DESC])->all()
        ]);
    }
    public function actionView($id)
    {
        $newsModel = News::find()->where(['active' => 1])->orderBy(['id' => SORT_DESC])->one();

        return $this->render('view', [
            'newsModel' => $newsModel
        ]);
    }
}