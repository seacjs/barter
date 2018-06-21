<?php

namespace app\controllers;

class RbacController extends FrontController
{

    public function actionIndex()
    {
        return $this->render('index',[

        ]);
    }

    public function actionAjaxCreatePermission(){}
    public function actionAjaxUpdatePermission(){}
    public function actionAjaxDeletePermission(){}


}