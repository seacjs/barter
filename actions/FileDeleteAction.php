<?php

namespace app\actions;

/* todo: this */
use Yii;
use yii\base\Action;
use app\models\File;
use yii\base\InvalidConfigException;
use yii\web\Response;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;

/**
 * Action for delete files
 *
 * For example:
 *
 * ```php
 * public function actions()
 * {
 *    return [
 *       'sort' => [
 *          'class' => FileDeleteAction::class,
 *          'modelName' => Model::class,
 *       ],
 *   ];
 * }
 * ```
 *
 * @author seacjs
 */
class FileDeleteAction extends Action
{
    public $modelName;

    public function run($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        File::findOne($id)->detach(true);
        return json_encode(true);
    }
}