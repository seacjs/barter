<?php
namespace app\commands;

use consik\yii2websocket\WebSocketServer;
use yii\console\Controller;
use app\daemons\ChatServer;
use yii\db\Connection;

class ChatController extends Controller
{
    public function actionStart()
    {
        $server = new ChatServer();
        $server->start();
    }

    /**
     * Testing timer systemD
     * */
    public function actionTest()
    {
        $connection = new \yii\db\Connection(\Yii::$app->db);
        $connection->open();

        $connection->createCommand()->insert('test', [
            'created_at' => time(),
            'message' => 'new message',
        ])->execute();
//        echo 'test';
    }
}
