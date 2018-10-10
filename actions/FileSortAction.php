<?php

namespace app\actions;

/* todo: this */
use Yii;
use yii\base\Action;
use app\models\File;
use yii\base\InvalidConfigException;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;

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
class FileSortAction extends Action
{
    public $modelName;

    public function run($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post('sort');
        $model = Yii::$app->request->post('model');

        $files = File::find()->where([
            'component' => $model
        ])->andWhere(['component_id' => $id])
            ->andWhere([
                ($post['oldIndex'] > $post['newIndex'] ? '>=' : '<='),
                'sort',
                $post['newIndex']
            ])
            ->andWhere([
                ($post['oldIndex'] > $post['newIndex'] ? '<' : '>'),
                'sort',
                $post['oldIndex']
            ])
            ->orderBy(['sort' =>  ($post['oldIndex'] > $post['newIndex'] ? SORT_ASC : SORT_DESC)])->all();

        $currentfile = File::find()
            ->where(['sort' => $post['oldIndex']])
            ->andWhere(['component_id' => $id])
            ->andWhere(['component' => $model])
            ->one();
        $currentfile->sort = $post['newIndex'];
//        return json_encode($id);
        $currentfile->save();

        foreach($files as $file) {
            $file->sort = $file->sort + ($post['oldIndex'] > $post['newIndex'] ? 1 : -1);
            $file->save();
        }

        return json_encode(true);
    }
}
