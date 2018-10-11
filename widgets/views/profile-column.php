<?php

use yii\bootstrap\Html;

?>


<div class="profile">
    <div class="profile__name"><?=$user->name?> <?=$user->second_name?></div>
    <div class="profile__image">
        <img src="<?=$user->avatar?>" alt="" class="profile__photo">
    </div>
    <div class="profile__info">

        <?php if($user->isMe || $user->isOnline): ?>
            <span class="profile__status">online</span>
        <?php else: ?>
            <span class="profile__status">offline</span>
        <?php endif ?>

        <div class="profile__bals_wrapper">
            <p class="profile__bals__caption">Мой баланс</p>
            <div class="profile__bals">
                <img src="/images/icons/bal.png" alt="" class="profile__bals-icon">
                <div class="profile__bals-number"><?=$user->money?></div>
            </div>
        </div>
    </div>

    <div class="profile__rating">
        <div class="profile__rating_caption">
            <p>Рейтинг</p>
        </div>
        <div class="profile__rating__seller">
            <p class="profile__rating__seller__caption">
                Продавец:
            </p>
                        <span class="profile__rating__seller__stars">
                          <i class="fas fa-star filled"></i>
                          <i class="fas fa-star filled"></i>
                          <i class="fas fa-star filled"></i>
                          <i class="fas fa-star filled"></i>
                          <i class="fas fa-star blank"></i>
                        </span>
            <p class="profile__rating__seler__number">
                4.7
            </p>
        </div>
        <div class="profile__rating__buyer">
            <p class="profile__rating__buyer__caption">
                Покупатель:
            </p>
            <span class="profile__rating__buyer__stars">
                <i class="fas fa-star filled"></i>
                <i class="fas fa-star filled"></i>
                <i class="fas fa-star filled"></i>
                <i class="fas fa-star blank"></i>
                <i class="fas fa-star blank"></i>
            </span>
            <p class="profile__rating__buyer__number">
                3.8
            </p>
        </div>
        <div class="profile__rating__buyer"></div>
    </div>

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
                    <img src="/images/icons/whatsup.png" alt="" />
                    <img src="/images/icons/viber.png" alt="" />
                </div>
                <div class="profile__skype">
                    <?=$user->profile->skype?>
                    <img src="/images/icons/skype.png" alt="" />
                </div>
                <div class="profile__email">
                    <p><?=$user->email?></p>
                    <i class="far fa-envelope"></i>
                </div>
            </div>
        </div>

        <?php if($user->isMe):?>
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
<!--            <div class="profile__button">-->
<!--                <a href="/profile/products" class="profile__link">-->
<!--                    <span class="lnr lnr-heart"></span>-->
<!--                    <span class="profile__link-text">Мои услуги</span>-->
<!--                </a>-->
<!--            </div>-->
            <div class="profile__button">
                <a href="/messages" class="profile__link">
                    <span class="lnr lnr-envelope"></span>
                    <span class="profile__link-text">Сообщения</span>
                    <div class="profile__message-flag" id="count-new-messages"><?php echo $countNewMessages ?></div>
                </a>
            </div>

            <div class="profile__button">
                <a href="/site/logout" class="profile__link">
                    <span class="lnr lnr-exit"></span>
                    <span class="profile__link-text">Выйти</span>
                </a>
            </div>
        </div>
        <?php else: ?>
            <div class="profile__buttons">

                <div class="profile__button">
                    <a href="/messages/view/<?=$user->id?>" class="profile__link">
                        <span class="lnr lnr-envelope"></span>
                        <span class="profile__link-text">Написать сообщение</span>
                    </a>
                </div>

                <div class="profile__button">
                    <a href="/user/transaction/<?=$user->id?>" class="profile__link">
                        <span class="lnr lnr-envelope"></span>
                        <span class="profile__link-text">перевод баллов</span>
                    </a>
                </div>

            </div>
        <?php endif ?>

    </div>
</div>