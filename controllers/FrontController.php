<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class FrontController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'denyCallback' => function($rule, $action) {
                    return \Yii::$app->response->redirect('/');
                },
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ],
        ];
    }

//    public $layout = 'dubl_main';
    public $layout = 'main';

}