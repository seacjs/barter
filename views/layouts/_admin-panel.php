<?php
/**
 * Created by PhpStorm.
 * User: sea-c
 * Date: 28.06.2018
 * Time: 18:03
 */


?>

<?php if(Yii::$app->user->can('admin')):?>

    <div style="padding: 5px; border-bottom: 1px solid #ccc; background: #eee;">
        <div class="">
            <div><b>Admin panel: </b></div>

            <?php if(Yii::$app->user->can('admin')):?>
                <li><a href="/region">Регионы</a></li>
            <?php endif ?>

            <?php if(Yii::$app->user->can('admin')):?>
                <li><a href="/city">города</a></li>
            <?php endif ?>

            <li><a href="/user">Пользователи</a></li>
            <li><a href="/category">категории товаров</a></li>
            <li><a href="/product/moderate">модерация объявлений</a></li>
        </div>
    </div>

<?php endif ?>


