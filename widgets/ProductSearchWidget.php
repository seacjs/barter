<?php

namespace app\widgets;

use app\models\User;
use app\models\UserSearch;
use Yii;
use yii\base\Widget;

class ProductSearchWidget extends Widget
{

    public $template = 'basic';
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $post = Yii::$app->request->post();

        return $this->render('product-search', [
            'post' => $post
        ]);
    }
}
