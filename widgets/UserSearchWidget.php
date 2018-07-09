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

        return $this->render('user-search', [
            'model' => $model
        ]);
    }
}
