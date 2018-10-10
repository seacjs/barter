<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>

    <?php

//    GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
//            'name',
//            'slug',
//            'content:ntext',
//            'category_id',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]);

    ?>

<div class="goods">

    <?= \app\widgets\UserSearchWidget::widget()?>

<!--    TODO: add full search column -->
<!--    <a href="/product/create" class="goods__add">+Добавить</a>-->

    <?php if(Yii::$app->user->can('admin')):?>
        <?php if(Yii::$app->controller->action->id === 'index'):?>
<!--            <a href="/product/moderate" class="goods__add">Модерировать</a>-->
        <?php else: ?>
<!--            <a href="/product/index" class="goods__add">вернутся к списку</a>-->
        <?php endif ?>
    <?php endif ?>

    <div class="goods__table-title">
        <div class="goods__table-name">Товары</div>
        <div class="goods__table-category">Категория</div>
<!--        <div class="goods__table-actions">Действия</div>-->
    </div>

    <?php foreach($products as $product): ?>

        <?= $this->render('/product/_productItem', [
                'product' => $product,
                'control' => false,
        ]); ?>

    <?php endforeach ?>


</div>


