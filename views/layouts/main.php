<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use app\assets\DublAsset;
use app\assets\ChatAsset;

AppAsset::register($this);
DublAsset::register($this);
//ChatAsset::register($this);


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

    <?=$this->render('header')?>

    <div class="container">

        <div class="row">
            <div class="col-sm-3"><?= \app\widgets\ProfileColumn::widget() ?></div>
            <div class="col-sm-6"><?= $content ?></div>
            <div class="col-sm-3"><?= \app\widgets\NotificationColumn::widget() ?></div>
        </div>

    </div>

</div>

<?=$this->render('footer');?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>