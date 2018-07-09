<?php
/**
 * Created by PhpStorm.
 * User: sea-c
 * Date: 23.06.2018
 * Time: 10:23
 */

?>

Вы зарегистрированы на сайте <?=Yii::$app->params['site']?>.<br>
Перейдите по ссылке, для подтверждения регистрации.<br>
<a href="<?=Yii::$app->params['site']?>site/confirm-email/?token=<?=$user->email_confirm_token?>">подтвердить</a>