<?php

use app\models\Message;

//$headers = \Yii::$app->request->headers;
//$res = $headers->get('cookie');
//echo \yii\helpers\VarDumper::dump($res,10,1);

//$array = \yii\helpers\ArrayHelper::toArray($client);
 // \yii\helpers\VarDumper::dump($model,10,1);

if(($model->status == Message::STATUS_NEW) && (!$me)) {
    $model->status = Message::STATUS_READ;
    $model->save();
}

?>



<?php if($me):?>
    <div class="chat_message_wrapper">
        <div class="chat_message_body my-message">
            <div class="chat_message_body_avatar">
                <img src="./images/people.png" alt="" class="chat_message_avatar_img">
            </div>
            <div class="chat_message_body_content">
                <div class="chat_message_body_content_header">
                    <p class="chat_message_body_content_status"><span>{messageDate}</span><?=$model->userFrom->username?></p>
                </div>
                <div class="chat_message_body_content_text">
                    <p><?=$model->message?></p>
                </div>
            </div>
        </div>
        <hr>
    </div>
<?php else:?>
    <!-- todo: after Vitaliy send me new template -->
    <div class="chat_message_wrapper">
        <div class="chat_message_body">
            <div class="chat_message_body_avatar">
                <img src="./images/people4.png" alt="" class="chat_message_avatar_img">
            </div>
            <div class="chat_message_body_content_text">
                <p><?=$model->message?></p>
            </div>
            <div class="chat_message_body">
                <p class="chat_message_body_status"><?=$model->userFrom->username?><span>{messageDate}</span></p>
            </div>
        </div>
        <hr>
    </div>
<?php endif ?>