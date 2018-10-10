<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProductGoods */
/* @var $user app\models\User */
/* @var $profile app\models\Profile */

//$this->title = $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>



<div class="product-detailed">

    <div class="service">
        <div class="service__title-and-breadcrumbs">
            <div class='breadcrumbs'>
<!--                <p>Десктопы <span>-</span> Ноутбук <span>-</span> HP</p>-->
            </div>
            <div class="title">
                <h4><?=$model->name?></h4>
            </div>
        </div>
        <?php \app\widgets\UserSearchWidget::widget()?>
    </div>


    <div class="product-detailed__gallery">
        <div class="product-detailed__gallery__mainframe">
            <div class="reccomend-label">
                <div class="main"><p>РЕКОМЕНДУЕМОЕ</p></div>
                <div class="arrow"></div>
                <div class="backside"></div>
            </div>
            <div class="image__gallery">
                <img src="<?=$model->file->image?>" alt="">
            </div>
        </div>
    </div>
    <div class="product-detailed__description">
        <div class="product-detailed__description__top">
            <?php if(!empty($model->options)):?>
                <b>Харакатеристики товара:</b>
                <table>
                    <?php foreach($model->options as $key => $option):?>
                    <tr>
                        <td><?=$option->name?></td>
                        <td><?=$model->getOptionModel()['option'.($key+1)]?></td>
                    </tr>
                    <?php endforeach ?>
                </table>
            <?php endif ?>
<!--            <p>Доступное количество: <span>9 шт</span></p>-->
        </div>
        <div class="product-detailed__description__bottom">
            <b>Подробное описание</b>
            <?= $model->content ?>
        </div>
    </div>
<!--    <div class="product-detailed__video">-->
<!--        <h5>Видео:</h5>-->
<!--        <iframe width="560" height="315" src="https://www.youtube.com/embed/jxuN7Ya0sGY" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>-->
<!--    </div>-->
</div>

<!-- profile menu begin -->
<div class="vendor__profile">
    <div class="profile__info">
        <div class="product__price_wrapper">
            <div class="product__price">
                <p>Цена:</p>
                <div class="product__price-number"><?=$model->price?></div>
                <img src="/images/icons/bal.png" alt="" class="product__price-icon">
            </div>
        </div>
        <?php if(!$user->isMe):?>
            <a class='general__button' href="/market/buy/<?=$model->id?>">Купить</a>
        <?php endif?>
    </div>

    <div class="vendor__profile__card_title">
        <h4>Контактные Данные Продавца</h4>
    </div>

    <!-- Vendor profile card -->
    <div class="vendor__profile__card">
        <div class="vendor__profile__card__avatar">
            <img src="/images/Profile.png" alt="" class="profile__photo">
            <span class="profile__status">
                <?php if($user->isMe || $user->isOnline): ?>
                    <span class="profile__status">online</span>
                <?php else: ?>
                    <span class="profile__status">offline</span>
                <?php endif ?>
            </span>
        </div>
        <div class="vendor__profile__contacts">
            <div class="profile__infoblock mt-0">
                <h4 class="profile__key"><?=$profile->name?></h4>
            </div>
            <div class="profile__infoblock">
                <span class="profile__key">Город:</span>
                <div class="profile__value">
                    <?php if(!$profile->show_city): ?>
                        <?=$profile->city->name?>
                    <?php else:?>
                        Скрыто
                    <?php endif ?>
                </div>
            </div>
            <div class="profile__infoblock">
                <span class="profile__key">Адрес:</span>
                <div class="profile__value">
                    <?php if(!$profile->show_address): ?>
                        <?php if($model->address === ''): ?>
                            <?=$profile->address?>
                        <?php else: ?>
                            <?=$model->address?>
                        <?php endif ?>
                    <?php else:?>
                        Скрыто
                    <?php endif ?>
                </div>
            </div>
            <div class="profile__infoblock">
                <span class="profile__key">Дата рождения:</span>
                <div class="profile__value">
                    <?php if(!$profile->show_birthday): ?>
                        <?=$profile->birthday?>
                    <?php else:?>
                        Скрыто
                    <?php endif ?>
                </div>
            </div>
            <div class="profile__infoblock">
                <span class="profile__key">Контакты:</span>
                <div class="profile__value">
                    <span class="profile__phone">
                        <?php if(!$profile->show_phone): ?>
                            <?=$profile->phone?>
                        <?php else:?>
                            Скрыто
                        <?php endif ?>
                    </span>
                    <div class="profile__social">
                        <?php if(!$profile->show_phone): ?>

                            <?php if($profile->telegram_on): ?>
                                <img src="/images/icons/telegram.png" alt="" />
                            <?php endif ?>

                            <?php if($profile->whatsapp_on): ?>
                                <img src="/images/icons/whatsup.png" alt="" />
                            <?php endif ?>

                            <?php if($profile->viber_on): ?>
                                <img src="/images/icons/viber.png" alt="" />
                            <?php endif ?>

                        <?php else:?>

                        <?php endif ?>

                    </div>
                    <div class="profile__skype">
                        <?php if(!$profile->show_skype): ?>
                            <?=$profile->skype?>
                            <img src="/images/icons/skype.png" alt="" />
                        <?php else:?>

                        <?php endif ?>
                    </div>
                    <div class="profile__email">
                        <?php if(!$profile->show_email): ?>
                            <p><?=$user->email?></p>
                            <i class="far fa-envelope"></i>
                        <?php else:?>

                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.vendor__profile__card-->

    <div class="profile__rating">
        <div class="profile__rating__seller">
            <p class="profile__rating__seller__caption">
                Рейтинг Продавца:
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
    </div>

    <!--
    <div class="vendor__profile__feedback">
        <div class="vendor__profile__card_title">
            <h3>Отзывы</h3>
        </div>
        <div class="vendor__profile__feedback__scroller">
            <div class="vendor__profile__feedback__card">
                <div class="vendor__profile__feedback__card__info">
                    <div class="vendor__profile__feedback___card__info__avatar">
                        <img src="./images/feedback_avatar.png" alt="">
                    </div>
                    <div class="vendor__profile__feedback__card__info__info">
                        <p>Иванов Иван Иванович</p>

                        <span><img src="./images/feedback__smile_positive.png" alt=""> <i class="date">20.03.2017</i></span>
                    </div>
                </div>
                <div class="vendor__profile__feedback__card__content">
                    <p>4 заказ...  Мне очень нравиться как получается
                        вписывать ключи у продавца! Толстый тайтл и
                        дескрипшн после моих обрезков очень красиов выглядят</p>
                </div>
                <hr>
            </div>
            <div class="vendor__profile__feedback__card">
                <div class="vendor__profile__feedback__card__info">
                    <div class="vendor__profile__feedback___card__info__avatar">
                        <img src="./images/feedback_avatar.png" alt="">
                    </div>
                    <div class="vendor__profile__feedback__card__info__info">
                        <p>Иванов Иван Иванович</p>

                        <span><img src="./images/feedback__smile_negative.png" alt=""> <i class="date">20.03.2017</i></span>
                    </div>
                </div>
                <div class="vendor__profile__feedback__card__content">
                    <p>4 заказ...  Мне очень нравиться как получается
                        вписывать ключи у продавца! Толстый тайтл и
                        дескрипшн после моих обрезков очень красиов выглядят</p>
                </div>
                <hr>
            </div>
            <div class="vendor__profile__feedback__card">
                <div class="vendor__profile__feedback__card__info">
                    <div class="vendor__profile__feedback___card__info__avatar">
                        <img src="./images/feedback_avatar.png" alt="">
                    </div>
                    <div class="vendor__profile__feedback__card__info__info">
                        <p>Иванов Иван Иванович</p>

                        <span><img src="./images/feedback__smile_neutral.png" alt=""> <i class="date">20.03.2017</i></span>
                    </div>
                </div>
                <div class="vendor__profile__feedback__card__content">
                    <p>4 заказ...  Мне очень нравиться как получается
                        вписывать ключи у продавца! Толстый тайтл и
                        дескрипшн после моих обрезков очень красиов выглядят</p>
                </div>
                <hr>
            </div>
            <div class="vendor__profile__feedback__card">
                <div class="vendor__profile__feedback__card__info">
                    <div class="vendor__profile__feedback___card__info__avatar">
                        <img src="./images/feedback_avatar.png" alt="">
                    </div>
                    <div class="vendor__profile__feedback__card__info__info">
                        <p>Иванов Иван Иванович</p>

                        <span><img src="./images/feedback__smile_positive.png" alt=""> <i class="date">20.03.2017</i></span>
                    </div>
                </div>
                <div class="vendor__profile__feedback__card__content">
                    <p>4 заказ...  Мне очень нравиться как получается
                        вписывать ключи у продавца! Толстый тайтл и
                        дескрипшн после моих обрезков очень красиов выглядят</p>
                </div>
                <hr>
            </div>
        </div>
        <div class="profile__vendor__feedback__post">
            <div class="vendor__profile__card_title">
                <h3>Оставить свой отзыв</h3>
            </div>
            <div class="vendor__profile__feedback__post__buttons">
                <button class="general__button positive">Положительный</button>
                <button class="general__button negative">Отрицательный </button>
            </div>
            <div class="vendor__profile__feedback__post__textfield">
                <textarea name="" id="" cols="35" rows="10" placeholder="Поделитесь опытом сотрудничества"></textarea>
            </div>
            <div class="vendor__profile__feedback__post__send">
                <button class="vendor__profile__feedback__post__sendbutton">СОХРАНИТЬ</button>
            </div>
        </div>
    </div>
    -->

</div>

<!-- profile menu end -->
