<?php

/**
 * Created by PhpStorm.
 * User: sea-c
 * Date: 28.05.2018
 * Time: 11:22
 */

//echo '<br><br><br><br><br><br><br><br><br><br><br>';

//$headers = \Yii::$app->request->headers;
//$res = $headers->get('cookie');
//$array = \yii\helpers\ArrayHelper::toArray(\Yii::$app->request);

//echo \yii\helpers\VarDumper::dump($array,10,1);

//$this->render('/layouts/header');
//$this->render('/layouts/_mainMenu');

?>

<div class="dialog-wrap" style="height: 600px;">

    <div>
        Переписка с пользователем: <?= $user->username ?>
        <hr>
    </div>

    <input type="hidden" id="user_from" value="<?=\Yii::$app->user->identity->username?>">
    <input type="hidden" id="user_to" value="<?=$user->username?>">

    <div class="dialog-messages">
        <div class="" id="chat">

            <?php foreach($messages as $message): ?>

                <?= $this->render('/messages/_message', [
                    'model' => $message,
                    'me' => $message->from === Yii::$app->user->id
                ]);?>

            <?php endforeach ?>

        </div>
    </div>
</div>
<div class="dialog-form">

<!--        <textarea id="message" rows="1"></textarea>-->
        <input id="message" type="text" style="width: 100%;">
<!--        <button id="btnSend">Send</button>-->
<!--        <div id="response" style="color:#D00"></div>-->
</div>
