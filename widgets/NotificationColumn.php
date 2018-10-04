<?php
namespace app\widgets;

use Yii;
use yii\base\Widget;

class NotificationColumn extends Widget
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        if(Yii::$app->controller->id === 'profile' && (
                Yii::$app->controller->action->id === 'users' ||
                Yii::$app->controller->action->id === 'products'

        )) {
            return $this->render('user-search-column');

        }
        return $this->render('notification-column');
    }
}
