<div class="message">
    <div class="search">
        <?php echo \app\widgets\UserSearchWidget::widget()?>
    </div>
    <div class="message__area">
        <div class="message__title">
            <img src="/images/icons/arrow-up.png" alt="">
            Исходящие
        </div>
        <div class="message__table-title">
            <div class="message__table-partner">Кому</div>
            <div class="message__table-price">Сумма</div>
            <div class="message__table-date">Дата</div>
            <div class="message__table-comment">Комментарий</div>
<!--            <div class="message__table-confirm">Подтверждено</div>-->
        </div>

        <?php foreach($outcomeTransactions as $transaction):?>
            <div class="message__block">

                <div class="message__partner">
                    <img class="message__partner-image" src="<?=$transaction->userTo->avatar?>" alt="">
                    <div class="message__partner-info">
                        <div class="message__partner-name"><?=$transaction->userTo->name?></div>
                        <div class="message__partner-city"><?=$transaction->userTo->profile->city->name?></div>
                    </div>
                </div>

                <div class="message__price">
                    <?=$transaction->value?>
                    <img src="/images/icons/bal-blue.png" alt="">
                </div>
                <div class="message__date">
                    <?=date('Y.m.d',$transaction->created_at)?>
                </div>
                <textarea class="message__comment"><?=$transaction->message?></textarea>
<!--                <div class="message__confirm">-->
<!--                    <div class="message__confirm-label">-->
<!--                        <img src="/images/icons/confirm-green.png" alt="">-->
<!--                    </div>-->
<!--                </div>-->
            </div>
        <?php endforeach ?>

    </div>
    <div class="message__area">
        <div class="message__title">
            <img src="/images/icons/arrow-down.png" alt="">
            Входящие
        </div>
        <div class="message__table-title">
            <div class="message__table-partner">От кого</div>
            <div class="message__table-price">Сумма</div>
            <div class="message__table-date">Дата</div>
            <div class="message__table-comment">Комментарий</div>
<!--            <div class="message__table-confirm">Подтверждено</div>-->
        </div>

        <?php foreach($incomeTransactions as $transaction): ?>
            <div class="message__block">
<!--                if($transacrion->user_from == null)-->
                <?php if($transaction->from_id == null):?>
                    от администратора системы
                <?php else: ?>
                    <div class="message__partner">
                        <img class="message__partner-image" src="<?=$transaction->userFrom->avatar?>" alt="">
                        <div class="message__partner-info">
                            <div class="message__partner-name"><?=$transaction->userFrom->name?></div>
                            <div class="message__partner-city"><?=$transaction->userFrom->profile->city->name?></div>
                        </div>
                    </div>
                <?php endif ?>

                <div class="message__price">
                    <?=$transaction->value?>
                    <img src="/images/icons/bal-blue.png" alt="">
                </div>

                <div class="message__date">
                    <?=date('Y.m.d',$transaction->created_at)?>
                </div>

                <textarea class="message__comment"><?=$transaction->message?></textarea>
                <!--                <div class="message__confirm">-->
                <!--                    <div class="message__confirm-label">-->
                <!--                        <img src="/images/icons/confirm-green.png" alt="">-->
                <!--                    </div>-->
                <!--                </div>-->

            </div>
        <?php endforeach ?>

    </div>
</div>