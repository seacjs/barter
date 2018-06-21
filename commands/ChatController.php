<?php
namespace app\commands;

use consik\yii2websocket\WebSocketServer;
use yii\console\Controller;
use app\daemons\ChatServer;

class ChatController extends Controller
{
    public function actionStart()
    {
        $server = new ChatServer();
        $server->start();
    }
}