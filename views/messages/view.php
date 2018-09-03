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


<div class="chat">
    <div class="chat__search search">
        <form action="">
            <input type="text" value="Поиск участника системы" class="search__input">
            <button class="search__go"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div class="chat_message-list" id="chat">

        <?php foreach($messages as $message): ?>

            <?= $this->render('/messages/_message', [
                'model' => $message,
                'me' => $message->from === Yii::$app->user->id
            ]);?>

        <?php endforeach ?>

    </div>
    <div class="message-editor">
        <input type="hidden" id="user_from" value="<?=\Yii::$app->user->identity->username?>">
        <input type="hidden" id="user_to" value="<?=$user->username?>">

        <textarea name="" id="message" cols="30" rows="5"></textarea>
        <!-- todo: reomve display:none and js handler on button onEnter-->
        <button style="display:none">send</button>
    </div>
</div>

<?= \app\widgets\NotificationColumn::widget() ?>