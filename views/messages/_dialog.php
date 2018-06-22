<?php
/**
 * Created by PhpStorm.
 * User: sea-c
 * Date: 19.06.2018
 * Time: 11:27
 */

$a = [
    'dialog' => $dialog,
    'user' => $user,
    'users' => $users,
];

//\yii\helpers\VarDumper::dump($user['id'],10,1);die;
?>


<div style="border: solid 1px #ccc;">
    <div>
        <img src="https://www.shareicon.net/data/2016/05/29/772558_user_512x512.png" width="40px" height="40px">
        <b><?=$dialog['from'] == $user['id'] ? $users[$dialog['to']]['username'] : $users[$dialog['from']]['username'] ?></b>
        <br>
        <b>Сообщение: </b><?= $dialog['message'] ?><br>
        <b><?=$dialog['from'] != $user['id'] ? '' : '(от меня)' ?></b><br>
        <span>Date: <?=date('Y.m.d', $dialog['created_at'])?></span><br>
        <b>Status: <?=$dialog['status'] == \app\models\Message::STATUS_NEW ? 'новое' : 'прочитано'?></b><br>
        <span><a onclick="disableButton = true;console.log(disableButton);" href="/messages/view/<?=$dialog['from'] == $user['id'] ? $dialog['to'] : $dialog['from']?>">Перейти к диалогу</a></span>
    </div>
</div>