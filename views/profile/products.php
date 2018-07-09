<?php
/**
 * Created by PhpStorm.
 * User: sea-c
 * Date: 08.07.2018
 * Time: 4:05
 */
?>
<div class="goods">


    <?= \app\widgets\UserSearchWidget::widget()?>

    <a href="/product/create" class="goods__add">+Добавить</a>
    <div class="goods__table-title">
        <div class="goods__table-name">Товары</div>
        <div class="goods__table-category">Категория</div>
        <div class="goods__table-actions">Действия</div>
    </div>

    <!---->

    <?php foreach($products as $product): ?>

        <?= $this->render('/product/_productItem',['product' => $product]); ?>

    <?php endforeach ?>

    <!---->
</div>