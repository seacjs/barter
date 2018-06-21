<?php

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\bootstrap\Html;

NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'tg-nav', /* stop here*/
//        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [

        !Yii::$app->user->isGuest && Yii::$app->user->can('superAdmin') ? (
            ['label' => 'c.p.', 'items' => [
                ['label' => 'users', 'url' => ['/admin/users']],
                ['label' => 'cities', 'url' => ['/admin/cities']],
            ]]
        ) : '',

        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],

        !Yii::$app->user->isGuest ? ['label' => 'Messages', 'url' => ['/messages']] : '',

        Yii::$app->user->isGuest ? ['label' => 'Registration', 'url' => ['/site/signup']] : (
            ['label' => Yii::$app->user->identity->username, 'items' => [
                ['label' => 'profile', 'url' => ['/profile']],
                ['label' => 'update', 'url' => ['/profile/update']],
            ]]
        ),

        Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/site/login']]
        ) : (
            '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>'
        ),

    ],
]);
NavBar::end();
