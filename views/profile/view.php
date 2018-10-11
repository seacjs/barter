<?php
/**
 * Created by PhpStorm.
 * User: sea-c
 * Date: 25.05.2018
 * Time: 13:34
 */

?>

<h1>
    User ID: <?=$model->user_id?><br>
    <small>username: <b><?=$model->user->username?></b></small>
</h1>
<?php if(Yii::$app->user->id != $model->user_id):?>
    <a href="/messages/view/<?=$model->user_id?>">написать сообщение</a>
<?php endif ?>