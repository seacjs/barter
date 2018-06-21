<?php
namespace app\widgets;

use app\models\Message;
use app\models\User;
use Yii;
use yii\base\Widget;
use app\widgets\assets\ProfileAsset;


class ProfileColumn extends Widget
{

    public $user;

    /**
     * {@inheritdoc}
     */
    public function init() {
        ProfileAsset::register( $this->getView() );
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $this->user = User::find()->where([
            'id' => Yii::$app->user->id
        ])->with('profile')->one();

        $countNewMessages = Message::find()->where([
            'to' => Yii::$app->user->id
        ])->count();

        return $this->render('profile-column', [
            'user' => $this->user,
            'countNewMessages' => $countNewMessages
        ]);
    }
}
