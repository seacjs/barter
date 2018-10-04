<?php
namespace app\daemons;

use Yii;
use app\models\Message;
use app\models\User;
use consik\yii2websocket\events\WSClientEvent;
use consik\yii2websocket\WebSocketServer;
use Ratchet\ConnectionInterface;
use yii\base\Controller;
use yii\helpers\VarDumper;
use yii\web\View;

class ChatServer extends WebSocketServer
{

    public function init()
    {
        parent::init();

        $this->on(self::EVENT_CLIENT_CONNECTED, function(WSClientEvent $e) {
            $e->client->name = null;

            $e->client->user = null;
            $e->client->user_id = null;

        });
    }

    protected function getCommand(ConnectionInterface $from, $msg)
    {
        $request = json_decode($msg, true);
        return !empty($request['action']) ? $request['action'] : parent::getCommand($from, $msg);
    }

//    public function commandSendMessage() {}

    /** todo::start */
    public $request;
    public $response;
    public function decodeMsg(){}
    public function beforeCommand(){}
    public function afterCommand(){/*???*/}
    /** todo::end */

    public function commandOnReady(ConnectionInterface $client, $msg) {
        $request = json_decode($msg, true);
        $result['message'] = 'Ready';
        $result['type'] = 'onReady';
        $client->send(json_encode($result));
    }

    public function commandMessage(ConnectionInterface $client, $msg)
    {
        $request = json_decode($msg, true);
        $result = ['message' => ''];
        $clientReceiver = $request['to'];

        if (!empty($request['message']) && $message = trim($request['message'])) {

            $userFrom = User::findByUsername($client->name);
            $userTo = User::findByUsername($clientReceiver);
            $messageModel = new Message();
            $messageModel->from = $userFrom->id;
            $messageModel->to = $userTo->id;
            $messageModel->message = $message;
            $messageModel->created_at = time();
            $messageModel->status = Message::STATUS_NEW;
            $messageModel->setUserFrom($userFrom);
            $messageModel->setUserTo($userTo);
            $messageModel->validate();
            $messageModel->save();

            foreach($this->clients as $chatClient) {
                if(($chatClient->user_id === $userFrom->id) || ($chatClient->user_id === $userTo->id)) {
                    $chatClient->send(json_encode([
                        'type' => 'chat',
                        'from' => $client->name,
                        'message' => (new \yii\web\View)->render('/messages/_message', [
                            'type' => 'chat',
                            'me' => $chatClient->user_id === $userFrom->id,
                            'model' => $messageModel
                        ]),
                    ]));

                }
            }
        } else {
            $result['message'] = 'Enter message';
        }

        $client->send(json_encode($result));
    }

    public function commandSetUser(ConnectionInterface $client, $msg)
    {
        $request = json_decode($msg, true);
        $result = ['message' => 'User updated.'];

        if (!empty($request['name']) && $name = trim($request['name'])) {

            $user = User::findByUsername($name);

            if($user !== null) {

                $client->name = $name;
                $client->user = $user;
                $client->user_id = $user->id;

            } else {

                $result['message'] = 'User not found';

            }

        } else {
            $result['message'] = 'Invalid username';
        }

        $client->send(json_encode($result));
    }

}