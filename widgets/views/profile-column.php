<?php

use yii\bootstrap\Html;

?>

<div class="row">

    <div class="col-sm-12">
        <img src="http://digilib.metrouniv.ac.id/wp-content/uploads/2017/05/avatar.jpg" class="img-thumbnail">
    </div>

    <div class="col-sm-12">
        <?php if($user->isMe || $user->isOnline): ?>
            <div class="label label-success">online</div>
        <?php else: ?>
            <div class="label label-danger">offline</div>
        <?php endif ?>
    </div>

    <div class="col-sm-12"><?=Html::a('Моя анкета', ['/profile'])?></div>
<!--    <div class="col-sm-12">--><?//=Html::a('Мои товары', ['/profile/products'])?><!--</div>-->
<!--    <div class="col-sm-12">--><?//=Html::a('Моя услуги', ['/profile/services'])?><!--</div>-->
    <div class="col-sm-12"><?=Html::a('Сообщения', ['/messages'])?> <span id="count-new-messages" class="label label-default"><?$countNewMessages?></span></div>
    <div class="col-sm-12"><?php echo Html::beginForm(['/site/logout'], 'post')
    . Html::submitButton('Выйти', ['class' => 'btn btn-link logout'])
    . Html::endForm()?></div>

</div>