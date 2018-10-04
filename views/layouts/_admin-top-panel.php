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
        <div class="container">
            <b>Admin panel: </b>

            <?php if(Yii::$app->user->can('admin')):?>
                <a href="/region">Регионы</a></li> |
            <?php endif ?>

            <?php if(Yii::$app->user->can('admin')):?>
                <a href="/city">города</a> |
            <?php endif ?>

            <a href="/user">Пользователи</a> |
            <a href="/category">категории товаров</a> |
            <a href="/product/moderate">модерация объявлений</a> |
            <a href="/product/moderate">вернуться к сайту</a>
        </div>
    </div>

<?php endif ?>

