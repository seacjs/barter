<?php
/**
 * Created by PhpStorm.
 * User: sea-c
 * Date: 14.09.2018
 * Time: 13:47
 */

?>


<div class="messages">
    <?= \app\widgets\UserSearchWidget::widget()?>

    <div class="transaction__info" >

        <?php $form = \yii\widgets\ActiveForm::begin([
        ])?>

            <div class="transaction__field transaction__field--pay">
                <label class="transaction__field-name">Перевести пользователю</label>
                <?= $form->field($moneyTransaction, 'value')->input('number',[])->label(false) ?>
<!--                <input type="text" value="" class="transaction__input transaction__input--pay">-->
                <img src="images/icons/bal-blue.png" alt="">
            </div>

            <div class="transaction__field">
                <label class="transaction__field-name">Комментарий к переводу</label>
<!--                <input type="text" value="" class="transaction__input transaction__input--comment">-->
                <?= $form->field($moneyTransaction, 'message')->textInput()->label(false)?>
            </div>


        <?= \yii\helpers\Html::button('Сохранить', [
                'class' => 'transaction__button',
                'type' => 'submit',
            ])?>

        <?php \yii\widgets\ActiveForm::end()?>

    </div>
    

</div>

<?= \app\widgets\ProfileColumn::widget([
    'user' => $user
]) ?>



