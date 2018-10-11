
<div class="messages">

    <?= \app\widgets\UserSearchWidget::widget()?>

    <div></div>

</div>

<?= \app\widgets\ProfileColumn::widget([
    'user' => $user
]) ?>