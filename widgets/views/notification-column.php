<?php

use yii\bootstrap\Html;

?>
<div class="cab-sidebar">



    <div class="cab-sidebar__buttons">
        <div class="cab-sidebar__button">
            <a href="#" class="cab-sidebar__link">
                <span class="lnr lnr-bullhorn"></span>
                <span class="cab-sidebar__link-text">Тематические чаты</span>
            </a>
        </div>
        <div class="cab-sidebar__button">
            <a href="#" class="cab-sidebar__link">
                <span class="lnr lnr-star"></span>
                <span class="cab-sidebar__link-text">Стратегия проекта</span>
            </a>
        </div>
        <div class="cab-sidebar__button">
            <a href="#" class="cab-sidebar__link">
                <span class="lnr lnr-layers"></span>
                <span class="cab-sidebar__link-text">Правила проекта</span>
            </a>
        </div>
        <div class="cab-sidebar__button">
            <a href="#" class="cab-sidebar__link">
                <span class="lnr lnr-location"></span>
                <span class="cab-sidebar__link-text">Предложения по интеграции</span>
            </a>
        </div>

        <?php
            $newsModel = \app\models\News::find()->where(['active' => 1])->orderBy(['id' => SORT_DESC])->one()
        ?>

        <?php if($newsModel != null):?>
            <div class="cab-sidebar__news">
                <div class="cab-sidebar__title">Новости проекта</div>
                <div class="cab-sidebar__content">
                    <div class="cab-sidebar__picture">
                        <img src="/images/News-image.png" alt="" class="cab-sidebar__image">
                    </div>

                    <div class="cab-sidebar__subtitle"><?=$newsModel->name?></div>
                    <div class="cab-sidebar__text"><?=$newsModel->content?></div>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>