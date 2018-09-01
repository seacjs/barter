<?php

namespace app\widgets;

use app\models\User;
use app\models\UserSearch;
use Yii;
use yii\base\Widget;

class UserSearchWidget extends Widget
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $model = new UserSearch();

        $post = Yii::$app->request->post();

        if(isset($post['UserSearch'])) {
            $model->load($post);
        }

        return $this->render('user-search', [
            'model' => $model
        ]);
    }
}
