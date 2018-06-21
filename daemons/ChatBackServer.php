<?php
namespace app\daemons;

use app\models\Message;
use app\models\User;
use consik\yii2websocket\events\WSClientEvent;
use consik\yii2websocket\WebSocketServer;
use Ratchet\ConnectionInterface;
use yii\base\Controller;
use yii\helpers\VarDumper;
use yii\web\View;

class ChatBackServer extends WebSocketServer
{

    public function init()
    {
        parent::init();

        $this->on(self::EVENT_CLIENT_CONNECTED, function(WSClientEvent $e) {
            $e->client->name = null;
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

        if (!empty($request['message']) && $message = trim($request['message']) ) {

            $userFrom = User::findByUsername($client->name);
            $userTo = User::findByUsername($clientReceiver);
            $messageModel = new Message();
            $messageModel->from = $userFrom->id;
            $messageModel->to = $userTo->id;
            $messageModel->message = $message;
            $messageModel->status = Message::STATUS_NEW;
            $messageModel->setUserFrom($userFrom);
            $messageModel->setUserTo($userTo);
//            $messageModel->save();

            foreach ($this->clients as $chatClient) {
                $chatClient->send( json_encode([
                    'type' => 'chat',
                    'from' => $client->name,
                    'message' => (new \yii\web\View)->render('/messages/_message', [
                        'type' => 'chat',
                        'from' => $client->name,
                        'something' => $client->somethingString,
                        'model' => $messageModel
                    ]),
                ]) );
            }
        } else {
            $result['message'] = 'Enter message';
        }

        $client->send(json_encode($result) );
    }


    public function commandChat(ConnectionInterface $client, $msg)
    {
        $request = json_decode($msg, true);
        $result = ['message' => ''];
        $clientReceiver = $request['to'];

        if(!empty($request['message']) && $message = trim($request['message'])) {

            $userFrom = User::findByUsername($client->name);
            $userTo = User::findByUsername($clientReceiver);
            $messageModel = new Message();
            $messageModel->from = $userFrom->id;
            $messageModel->to = $userTo->id;
            $messageModel->message = $message;
            $messageModel->status = Message::STATUS_NEW;
            $messageModel->setUserFrom($userFrom);
            $messageModel->setUserTo($userTo);
//            $messageModel->save();

            foreach($this->clients as $chatClient) {
                if($chatClient->name == $clientReceiver) {
                    $chatClient->send(json_encode([
                        'type' => 'chat',
                        'from' => $client->name,
                        'model' => $messageModel
                    ]));
                }
            }

        } else {
            $result['message'] = 'Enter message';
        }

        $client->send(json_encode($result));
    }

    public function commandSetName(ConnectionInterface $client, $msg)
    {
        $request = json_decode($msg, true);
        $result = ['message' => 'Username updated.'];

        if (!empty($request['name']) && $name = trim($request['name'])) {
            $usernameFree = true;
            foreach ($this->clients as $chatClient) {
                if ($chatClient != $client && $chatClient->name == $name) {
                    $result['message'] = 'This name is used by other user';
                    $usernameFree = false;
                    break;
                }
            }

            if ($usernameFree) {
                $client->name = $name;
                $client->somethingString = time();
            }
        } else {
            $result['message'] = 'Invalid username';
        }

        $client->send( json_encode($result) );
    }

}