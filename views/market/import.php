<?php
/**
 * Created by PhpStorm.
 * User: seacjs
 * Date: 10.10.2018
 * Time: 11:28
 */

?>
<div class="import">
    <div class="search">
        <?= \app\widgets\UserSearchWidget::widget()?>
    </div>
    <div class="import__area">
        <div class="import__title">
            <img src="images/icons/arrow-down.png" alt="">
            Ожидают поступления
        </div>
        <div class="import__table-title">
            <div class="import__table-name">Товары/услуги</div>
            <div class="import__table-partner">Получатель, заказчик</div>
            <div class="import__table-conditions">Условия подтверждения, сроки</div>
            <div class="import__table-actions">Действия</div>
        </div>
        <?php foreach($deals as $deal):?>
            <div class="import__block">
                <div class="import__block-name">
                    <div class="import__good">
                        <img class="import__image" src="<?=$deal->product->file->thumbnail?>" alt="">
                        <div class="import__info">
                            <span class="import__name"><?=$deal->product->name?></span>
                            <span class="import__quantity"></span>
                            <div class="import__price">
                                <?=$deal->transaction->value?>
                                <img src="/images/icons/bal-grey.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="import__pay-date">
                        Перечислено: <?=date('Y.m.d', $deal->transaction->created_at)?>
                    </div>
                </div>
                <div class="import__block-partner">
                    <span class="import__partner-name"><?=$deal->transaction->userTo->profile->name?></span>
                    <img class="import__partner-photo" src="http://digilib.metrouniv.ac.id/wp-content/uploads/2017/05/avatar.jpg" alt="">
                    <span class="import__partner-city"><?=$deal->transaction->userTo->profile->city->name?></span>
                </div>
                <div class="import__block-conditions">
                    <span class="import__status">Ожидает подтверждения</span>
<!--                    <span class="import__date">Срок подтверждения до: 27.0.2017</span>-->
                </div>
                <div class="import__block-actions">
                    <a class="import__accept" href="/market/confirm/<?=$deal->id?>">
                        Подтвердить
                    </a>
                    <a class="import__dialog" href="/messages/view/<?=$deal->transaction->to_id?>">
                        Диалог
                    </a>
<!--                    <a class="import__dispute">-->
<!--                        Спор-->
<!--                    </a>-->
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="import__history">
        <div class="import__title">
            История сделок
        </div>
        <?php foreach($dealsArchive as $deal):?>

        <div class="import__block">
            <div class="import__block-name">
                <div class="import__good">
                    <img class="import__image" src="<?=$deal->product->file->thumbnail?>" alt="">
                    <div class="import__info">
                        <span class="import__name"><?=$deal->product->name?></span>
                        <span class="import__quantity"></span>
                        <div class="import__price">
                            <?=$deal->transaction->value?>
                            <img src="/images/icons/bal-grey.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="import__pay-date">

                </div>
            </div>
            <div class="import__block-partner">
                <span class="import__partner-name"><?=$deal->transaction->userTo->profile->name?></span>
                <img class="import__partner-photo" src="http://digilib.metrouniv.ac.id/wp-content/uploads/2017/05/avatar.jpg" alt="">
                <span class="import__partner-city"><?=$deal->transaction->userTo->profile->city->name?></span>
            </div>
            <div class="import__block-confirm">
                <div class="import__confirm">Подтверждено</div>
            </div>
            <div class="import__block-actions">
                <?=date('Y.m.d', $deal->transaction->updated_at)?>
            </div>
        </div>

        <?php endforeach ?>

    </div>
</div>
