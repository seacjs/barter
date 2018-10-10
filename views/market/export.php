<?php
/**
 * Created by PhpStorm.
 * User: seacjs
 * Date: 10.10.2018
 * Time: 11:28
 */

?>
<div class="export">
    <div class="search">
        <?= \app\widgets\UserSearchWidget::widget()?>
    </div>
    <div class="export__area">
        <div class="export__title">
            <img src="images/icons/arrow-down.png" alt="">
            Ожидают поступления
        </div>
        <div class="export__table-title">
            <div class="export__table-name">Товары/услуги</div>
            <div class="export__table-partner">Получатель, заказчик</div>
            <div class="export__table-conditions">Условия подтверждения, сроки</div>
            <div class="export__table-actions">Действия</div>
        </div>
        <?php foreach($deals as $deal):?>
            <div class="export__block">
                <div class="export__block-name">
                    <div class="export__good">
                        <img class="export__image" src="<?=$deal->product->file->thumbnail?>" alt="">
                        <div class="export__info">
                            <span class="export__name"><?=$deal->product->name?></span>
                            <span class="export__quantity"></span>
                            <div class="export__price">
                                <?=$deal->transaction->value?>
                                <img src="/images/icons/bal-grey.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="export__pay-date">
                        Перечислено: <?=date('Y.m.d', $deal->transaction->created_at)?>
                    </div>
                </div>
                <div class="export__block-partner">
                    <span class="export__partner-name"><?=$deal->transaction->userTo->profile->name?></span>
                    <img class="export__partner-photo" src="http://digilib.metrouniv.ac.id/wp-content/uploads/2017/05/avatar.jpg" alt="">
                    <span class="export__partner-city"><?=$deal->transaction->userTo->profile->city->name?></span>
                </div>
                <div class="export__block-conditions">
                    <span class="export__status">Ожидает подтверждения</span>
                    <!--                    <span class="export__date">Срок подтверждения до: 27.0.2017</span>-->
                </div>
                <div class="export__block-actions">
                    <a class="export__dialog" href="/messages/view/<?=$deal->transaction->to_id?>">
                        Диалог
                    </a>
                    <!--                    <a class="export__dispute">-->
                    <!--                        Спор-->
                    <!--                    </a>-->
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="export__history">
        <div class="export__title">
            История сделок
        </div>
        <?php foreach($dealsArchive as $deal):?>

            <div class="export__block">
                <div class="export__block-name">
                    <div class="export__good">
                        <img class="export__image" src="<?=$deal->product->file->thumbnail?>" alt="">
                        <div class="export__info">
                            <span class="export__name"><?=$deal->product->name?></span>
                            <span class="export__quantity"></span>
                            <div class="export__price">
                                <?=$deal->transaction->value?>
                                <img src="/images/icons/bal-grey.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="export__pay-date">

                    </div>
                </div>
                <div class="export__block-partner">
                    <span class="export__partner-name"><?=$deal->transaction->userTo->profile->name?></span>
                    <img class="export__partner-photo" src="http://digilib.metrouniv.ac.id/wp-content/uploads/2017/05/avatar.jpg" alt="">
                    <span class="export__partner-city"><?=$deal->transaction->userTo->profile->city->name?></span>
                </div>
                <div class="export__block-confirm">
                    <div class="export__confirm">Подтверждено</div>
                </div>
                <div class="export__block-actions">
                    <?=date('Y.m.d', $deal->transaction->updated_at)?>
                </div>
            </div>

        <?php endforeach ?>

    </div>
</div>
