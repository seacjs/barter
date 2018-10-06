<?php
/**
 * Created by PhpStorm.
 * User: seacjs
 * Date: 06.10.2018
 * Time: 14:47
 */

?>


<div class="people__block">
    <img class="people__profile" src='/images/people1.png'>
    <div class="people__rating">5</div>
    </img>
    <div class="people__info">
        <a href="/user/transaction/<?=$model->id?>"><span class="people__name"><?=$model->username?></span></a>
        <span class="people__city"><?=$model->profile->city->name?></span>
    </div>
    <?php if($model->isMe || $model->isOnline): ?>
        <div class="people__status people__status--online"></div>
    <?php else: ?>
        <div class="people__status"></div>
    <?php endif ?>
    <a href="/messages/view/<?=$model->id?>"><button class="people__button" >Написать</button></a>
</div>
