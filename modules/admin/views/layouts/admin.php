<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

use app\assets\AdminAsset;
AdminAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?php NavBar::begin([
        'brandLabel' => Yii::$app->name . ' Admin Panel',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [

            ['label' => 'Управление баллами', 'url' => ['/admin/money']],

//            !Yii::$app->user->isGuest && Yii::$app->user->can('superAdmin') ? (
//            ['label' => 'c.p.', 'items' => [
//                ['label' => 'users', 'url' => ['/admin/users']],
//                ['label' => 'cities', 'url' => ['/admin/cities']],
//            ]]
//            ) : '',

            ['label' => 'Местоположение', 'items' => [
                ['label' => 'регионы', 'url' => ['/admin/region']],
                ['label' => 'города', 'url' => ['/admin/city']],
//                ['label' => 'метро', 'url' => ['/admin/metro']],
            ]],

            ['label' => 'пользователи', 'url' => ['/admin/user']],
            ['label' => 'категории', 'items' => [
                ['label' => 'категории товаров', 'url' => ['/admin/category-goods']],
//                ['label' => 'категории услуг', 'url' => ['/admin/category-service']],
            ]],
//            ['label' => 'объявления', 'items' => [
//                ['label' => 'объявления товаров', 'url' => ['/admin/product-goods']],
//                ['label' => 'объявления услуг', 'url' => ['/admin/product-service']],
//            ]],

            ['label' => 'новости', 'url' => ['/admin/news']],

            Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'выйти',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),

        ],
    ]);
    NavBar::end();?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
