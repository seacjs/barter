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



<a class="messages__block" href="/messages/view/<?=$dialog['from'] == $user['id'] ? $dialog['to'] : $dialog['from']?>">
    <div class="messages__photo"><img src="images/people5.png" alt=""></div>
    <div class="messages__info">
        <div class="messages__name"><?=$dialog['from'] == $user['id'] ? $users[$dialog['to']]['username'] : $users[$dialog['from']]['username'] ?></div>
        <div class="messages__text"><?= $dialog['message'] ?></div>
    </div>
    <div class="messages__answer">
        <?php if($dialog['from'] != $user['id']): ?>
            <div class="messages__my-photo"><img src="images/people.png" alt=""></div>
        <?php else:?>
            <?php if($dialog['status'] == \app\models\Message::STATUS_NEW):?>
                <!-- todo: count new messages -->
                <div class="messages__kolvo">new</div>
            <?php endif?>
        <?php endif?>
        <div class="messages__date"><?=date('Y.m.d', $dialog['created_at'])?></div>
    </div>
</a>

