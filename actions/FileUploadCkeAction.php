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
 * Action for upload files in CKEditor
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
class FileUploadCkeAction extends Action
{
    public $modelName;

    public function run()
    {
        $post = Yii::$app->request->get();

        if(Yii::$app->request->isPost) {
            $className = $post['model'];
            $model = $className::findOne($post['component_id']);

            $fileModel = new File();
            $fileModel->multiple = true;
            $uploadedFiles = $fileModel->upload($model, 'upload');

            foreach ($uploadedFiles as $key => $uploadedFile) {
                $uploadedFile->image_category = File::IMAGE_CATEGORY_CONTENT;
                $uploadedFile->component = $post['component'];
                $uploadedFile->component_id = $post['component_id'];
                $uploadedFile->sort = count($model->contentFiles) + $key;
                $uploadedFile->save();

                $full_path = $uploadedFile->image; // "/images/IMG_6782.JPG";
                $message = 'Файл загружен.';
                /* todo: What is this: CKEditorFuncNum*/
                $callback = $_REQUEST['CKEditorFuncNum'];
            }
        }

        /* todo: get CKEDITOR id instance not general CKE */
        return '<script>window.parent.CKEDITOR.tools.callFunction("'.$callback.'", "'.$full_path.'", "'.$message.'" );</script>';
    }
}
