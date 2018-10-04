<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="people">

    <?= \app\widgets\UserSearchWidget::widget()?>

    <div class="people__title">Участники</div>
    <div class="people__content">
        <div class="people__main">

            <?php foreach($users as $user):?>

                <div class="people__block">
                    <img class="people__profile" src='/images/people1.png'>
                    <div class="people__rating">5</div>
                    </img>
                    <div class="people__info">
                        <a href="/user/transaction/<?=$user->id?>"><span class="people__name"><?=$user->username?></span></a>
                        <span class="people__city"><?=$user->profile->city->name?></span>
                    </div>
                    <?php if($user->isMe || $user->isOnline): ?>
                        <div class="people__status people__status--online"></div>
                    <?php else: ?>
                        <div class="people__status"></div>
                    <?php endif ?>
                    <a href="/messages/view/<?=$user->id?>"><button class="people__button" >Написать</button></a>
                </div>

            <?php endforeach ?>

        </div>
        <div class="people__sidebar">
            <div class="people__city-chose">
                <select class="people__city-list">
                    <option selected>Выбор города</option>
                    <option>Москва</option>
                    <option>Санкт-Петербург</option>
                    <option>Волгоград</option>
                    <option>Владивосток</option>
                    <option>Воронеж</option>
                    <option>Екатеринбург</option>
                    <option>Казань</option>
                    <option>Волгоград</option>
                    <option>Владивосток</option>
                    <option>Воронеж</option>
                    <option>Екатеринбург</option>
                    <option>Казань</option>
                    <option>Волгоград</option>
                    <option>Владивосток</option>
                    <option>Воронеж</option>
                    <option>Екатеринбург</option>
                    <option>Казань</option>
                </select>
            </div>
            <div class="people__age-chose">
                Возраст
                <select class="people__age">
                    <option selected>от</option>
                    <?php
                    for($i = 18; $i <= 100; $i++) {
                        echo '<option value="">'.$i.'</option>';
                    }
                    ?>
                </select>
                -
                <select class="people__age">
                    <option selected>до</option>
                    <?php
                    for($i = 18; $i <= 100; $i++) {
                        echo '<option value="">'.$i.'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
</div>