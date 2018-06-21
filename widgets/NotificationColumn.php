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
        return $this->render('notification-column');
    }
}
