<?php

use yii\bootstrap\Html;

?>

<div class="profile">
    <div class="profile__name"><?=$user->username?></div>
    <div class="profile__image">
        <img src="http://digilib.metrouniv.ac.id/wp-content/uploads/2017/05/avatar.jpg" alt="" class="profile__photo">
        <div class="profile__rating">5</div>
        <div class="profile__bals">
            <img src="images/icons/bal.png" alt="" class="profile__bals-icon">
            <div class="profile__bals-number">2680</div>
        </div>
    </div>

    <?php if($user->isMe || $user->isOnline): ?>
        <span class="profile__status">online</span>
    <?php else: ?>
        <span class="profile__status">offline</span>
    <?php endif ?>

    <div class="profile__content">
        <div class="profile__infoblock">
            <span class="profile__key">Город:</span>
            <div class="profile__value"><?=$user->profile->city->name?></div>
        </div>
        <div class="profile__infoblock">
            <span class="profile__key">Адрес:</span>
            <div class="profile__value"><?=$user->profile->address?></div>
        </div>
        <div class="profile__infoblock">
            <span class="profile__key">Дата рождения:</span>
            <div class="profile__value"><?=$user->profile->birthday?></div>
        </div>
        <div class="profile__infoblock">
            <span class="profile__key">Контакты:</span>
            <div class="profile__value">
                <span class="profile__phone"><?=$user->profile->phone?></span>
                <div class="profile__social">
                    <img src="/images/icons/telegram.png" alt=""/>
                    <img src="/images/icons/whatsup.png" alt=""/>
                    <img src="/images/icons/viber.png" alt=""/>
                </div>
                <div class="profile__skype">
                    <?=$user->profile->skype?>
                    <img src="/images/icons/skype.png" alt=""/>
                </div>
                <div class="profile__email">
                    <?=$user->email?>
                </div>
            </div>
        </div>
        <div class="profile__buttons">
            <div class="profile__button">
                <a href="/profile/update" class="profile__link">
                    <span class="lnr lnr-cog"></span>
                    <span class="profile__link-text">Моя анкета</span>
                </a>
            </div>
            <div class="profile__button">
                <a href="/profile/products" class="profile__link">
                    <span class="lnr lnr-cart"></span>
                    <span class="profile__link-text">Мои товары</span>
                </a>
            </div>
            <div class="profile__button">
                <a href="/profile/products" class="profile__link">
                    <span class="lnr lnr-heart"></span>
                    <span class="profile__link-text">Мои услуги</span>
                </a>
            </div>
            <div class="profile__button">
                <a href="/messages" class="profile__link">
                    <span class="lnr lnr-envelope"></span>
                    <span class="profile__link-text">Сообщения</span>
                    <div class="profile__message-flag"><?php echo $countNewMessages ?></div>
                </a>
            </div>

            <div class="profile__button">
                <a href="/site/logout" class="profile__link">
                    <span class="lnr lnr-exit"></span>
                    <span class="profile__link-text">Выйти</span>
                </a>
            </div>


        </div>

        <div class="profile__buttons">
            <div class="profile__infoblock">
                <?=$this->render('/layouts/_admin-panel',[])?>
            </div>
        </div>

    </div>
</div>
