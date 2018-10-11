<?php

namespace app\actions;

/* todo: this */
use Yii;
use yii\base\Action;
use app\models\File;
use yii\base\InvalidConfigException;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\JsExpression;

/**
 * Action for upload files
 *
 * For example:
 *
 * ```php
 * public function actions()
 * {
 *    return [
 *       'sort' => [
 *          'class' => FileUploadAction::class,
 *          'modelName' => Model::class,
 *       ],
 *   ];
 * }
 * ```
 *
 * @author seacjs
 */
class FileUploadAction extends Action
{
    public $modelName;

    public function run()
    {

        $post = Yii::$app->request->post();

        if(Yii::$app->request->isPost) {
            $className = $post['model'];
            $model = $className::findOne($post['component_id']);

            if($post['multiple'] == 'true') {
                $uploadModel = false;
            } else {
                $uploadModel = $model;
            }

            $fileModel = new File();
            $uploadedFiles = $fileModel->upload($uploadModel);

            foreach($uploadedFiles as $key => $uploadedFile) {
                $uploadedFile->image_category = File::IMAGE_CATEGORY_MAIN;
                $uploadedFile->component = $post['component'];
                $uploadedFile->component_id = $post['component_id'];
                $uploadedFile->sort = count($model->mainFiles) + $key;
                $uploadedFile->save();
            }

            return json_encode([
                'initialPreview' => \app\models\File::initialPreview($uploadedFiles),
                'initialPreviewConfig' => \app\models\File::initialPreviewConfig($uploadedFiles)
            ]);

        }
        return json_encode(false);
    }
}
