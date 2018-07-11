<?php
namespace app\widgets;

use app\widgets\assets\AdminPanelAsset;
use Yii;
use yii\base\Widget;

/**
 * Admin panel on site as sidebar
 * */
class AdminPanel extends Widget
{

    /**
     * {@inheritdoc}
     */
    public function init() {
        AdminPanelAsset::register($this->getView());
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('admin-panel');

        if(Yii::$app->user->can('admin')) {
            return $this->render('admin-panel');
        } else {
            return '';
        }
    }
}
