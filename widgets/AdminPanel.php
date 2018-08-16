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
     * Is admin panel Open is true
     */
    public $isOpen = true;
    /**
     * {@inheritdoc}
     */
    public function init() {
        AdminPanelAsset::register($this->getView());
        $this->panelPosition();
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('admin-panel', [
            'isOpen' => $this->isOpen,
        ]);

        if(Yii::$app->user->can('admin')) {
            return $this->render('admin-panel');
        } else {
            return '';
        }
    }
    public function panelPosition() {
        $session = Yii::$app->session;
        if($session->has('admin-panel-open')) {
            $this->isOpen = $session->get('admin-panel-open', $this->isOpen);
        }

    }
}
