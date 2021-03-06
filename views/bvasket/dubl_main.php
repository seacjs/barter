<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\DublAsset;
use app\assets\ChatAsset;

AppAsset::register($this);
DublAsset::register($this);
ChatAsset::register($this);

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

<div id="tg-wrapper" class="tg-wrapper tg-haslayout">

    <?=$this->render('header')?>

    <?= $content ?>

    <?=$this->render('footer');?>

</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>



