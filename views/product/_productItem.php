<?php
/**
 * Created by PhpStorm.
 * User: sea-c
 * @var $this yii\web\View
 * @var $model app\models\Product
 */

?>

<div class="goods__block">
    <div class="goods__picture"><img src="/images/good1.png" alt="" class="goods__image"></div>
    <div class="goods__info">
        <div class="goods__name"><?=$product->name?></div>
        <div class="goods__date-n-price">
            <div class="goods__date"><?=date('d.m.Y', $product->created_at)?></div>
            <div class="goods__price">
                <img src="/images/icons/bal-blue.png" alt="">
                <span class="goods__number">2680</span>
            </div>
        </div>
    </div>
    <div class="goods__category"><?=$product->category->name?></div>
    <div class="goods__actions">
        <?php if(Yii::$app->user->id == $product->user_id || Yii::$app->user->can('admin')):?>
            <?php if((
                $product->status === $product::STATUS_NEW ||
                $product->status === $product::STATUS_UPDATED
            ) && Yii::$app->user->can('admin')):?>
                <a href="/product/activate/<?=$product->id?>"><button class="goods__button goods__button--activate" title="активировать"><i class="fa fa-eye"></i></button></a>
            <?php endif ?>

            <a href="/product/update/<?=$product->id?>"><button class="goods__button goods__button--change" title="редактировать"><i class="fa fa-pencil"></i></button></a>
            <a href="/product/delete/<?=$product->id?>"><button class="goods__button goods__button--delete" title="удалить"><i class="fa fa-trash"></i></button></a>
        <?php endif ?>
    </div>
</div>
