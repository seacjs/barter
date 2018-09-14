<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form ActiveForm */

?>

<div class="cab-main">

    <div class="cab-main__photo-block">
        <div class="cab-main__title">Фото профиля</div>
        <div class="cab-main__content">
            <img src="images/Profile.png" alt="" class="cab-main__profile-photo">
            <div class="cab-main__text">
                <div class="cab-main__first-text">Используйте свое фото <br> это повысит лояльность и доверие к вам <br> со стороны других участников системы.</div>
                <div class="cab-main__second-text">Максимальный размер для загрузки 500Кб</div>
            </div>
            <button class="cab-main__button cab-main__button--photo">Загрузить/изменить</button>
        </div>
    </div>

    <?= $this->render('/user/_profileFields', [
        'model' => $model
    ]) ?>

<!--    <div class="cab-main__password-block">-->
<!--        <div class="cab-main__password-form">-->
<!--            <div class="cab-main__title">Сменить пароль</div>-->
<!--            <form action="">-->
<!--                <input type="password" placeholder="Текущий пароль" class="cab-main__input cab-main__input--password">-->
<!--                <input type="password" placeholder="Новый пароль" class="cab-main__input cab-main__input--password">-->
<!--                <input type="password" placeholder="Повторите новый пароль" class="cab-main__input cab-main__input--password">-->
<!--                <button class="cab-main__button cab-main__button--password">Сохранить</button>-->
<!--            </form>-->
<!--        </div>-->
<!--        <div class="cab-main__text cab-main__text--password">Используйте пароль не менее 8 символов <br>заглавные, строчные буквы и цифры.</div>-->
<!--    </div>-->

</div>