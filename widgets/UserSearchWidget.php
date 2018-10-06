<?php

namespace app\widgets;

use app\models\User;
use app\models\UserSearch;
use Yii;
use yii\base\Widget;

class UserSearchWidget extends Widget
{

    public $template = 'basic';
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

        if($this->template == 'full') {
            return $this->render('user-search-column', [
                'model' => $model
            ]);
        } else {
            return $this->render('user-search', [
                'model' => $model
            ]);
        }

    }
}
