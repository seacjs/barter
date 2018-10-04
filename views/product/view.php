<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

//$this->title = $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-detailed">
    <div class="product-detailed__gallery">
        <div class="product-detailed__gallery__mainframe">
            <div class="reccomend-label">
                <div class="main"><p>РЕКОМЕНДУЕМОЕ</p></div>
                <div class="arrow"></div>
                <div class="backside"></div>
            </div>
            <div class="image__gallery">
                <img src="./images/laptop_description_main.png" alt="">
            </div>
        </div>

    </div>
    <div class="product-detailed__description">
        <div class="product-detailed__description__top">
            <b>Харакатеристики товара:</b>
            <table>
                <tr>
                    <td>Характеристика 1</td>
                    <td>2х ядерный</td>
                </tr>
                <tr>
                    <td>Характеристика 2</td>
                    <td>Белый</td>
                </tr>
                <tr>
                    <td>Характеристика 3</td>
                    <td>Новый с гарантией</td>
                </tr>
            </table>
            <p>Доступное количество: <span>9 шт</span></p>
        </div>
        <div class="product-detailed__description__bottom">
            <b>Подробное описание</b>
            <p>Introducing Brand New Hp dual core 2gb ram-slim laptop. <br>Introducing Brand New Hp dual core 2gb ram-slim laptop</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam dolore, est natus ipsum rem iusto repudiandae, dolores voluptatibus dignissimos labore distinctio? Atque enim deleniti velit. Deserunt doloribus animi ut maxime!</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla sunt impedit ea eligendi quis laboriosam, quia adipisci. Esse aliquam voluptas, quam itaque tempora facere maxime, fugit nisi quos odit ea!</p>
            <ul>
                <li>Lorem ipsum dolor sit amet consectetur adipi</li>
                <li>isicing elit. Veniam dolore, est natus ipsum rem iusto rep</li>
                <li>stinctio? Atque enim deleniti velit. Deserunt do</li>
                <li>udiandae, dolores voluptatibus dignissimos labore di</li>
                <li>riosam, quia adipisci. Esse aliquam voluptas, quam ita</li>
            </ul>
        </div>
    </div>
    <div class="product-detailed__video">
        <h5>Видео:</h5>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/jxuN7Ya0sGY" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
</div>

<!-- profile menu begin -->

<div class="vendor__profile">
    <div class="profile__info">
        <div class="product__price_wrapper">
            <div class="product__price">
                <p>Цена:</p>
                <div class="product__price-number">2680</div>
                <img src="images/icons/bal.png" alt="" class="product__price-icon">
            </div>
        </div>
        <button class='general__button'>Добавить в желания</button>
    </div>

    <div class="vendor__profile__card_title">
        <h4>Контактные Данные Продавца</h4>
    </div>

    <div class="vendor__profile__card">
        <div class="vendor__profile__card__avatar">
            <img src="images/Profile.png" alt="" class="profile__photo">
            <span class="profile__status">online</span>
        </div>
        <div class="vendor__profile__contacts">
            <div class="profile__infoblock mt-0">
                <h4 class="profile__key">Иванов Иван Иванович</h4>
            </div>
            <div class="profile__infoblock">
                <span class="profile__key">Город:</span>
                <div class="profile__value">Москва</div>
            </div>
            <div class="profile__infoblock">
                <span class="profile__key">Адрес:</span>
                <div class="profile__value">м. Красносельская ул. Нижняя красносельская д.40</div>
            </div>
            <div class="profile__infoblock">
                <span class="profile__key">Дата рождения:</span>
                <div class="profile__value">29.03.1986г.</div>
            </div>
            <div class="profile__infoblock">
                <span class="profile__key">Контакты:</span>
                <div class="profile__value">
                    <span class="profile__phone">+7 926 669 95 20</span>
                    <div class="profile__social">
                        <img src="images/icons/whatsup.png" alt="" />
                        <img src="images/icons/viber.png" alt="" />
                    </div>
                    <div class="profile__skype">
                        testman
                        <img src="images/icons/skype.png" alt="" />
                    </div>
                    <div class="profile__email">
                        <p>testman@mail.ru</p>
                        <i class="far fa-envelope"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

</div>

<!-- profile menu end -->
