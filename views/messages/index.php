<?php

//\yii\helpers\VarDumper::dump($dialogs,10,1);
use yii\widgets\Pjax;
use yii\bootstrap\Html;



?>



<div class="messages">

    <div class="messages__search search">
        <form action="">
            <input type="text" value="Поиск участника системы" class="search__input">
            <button class="search__go"><i class="fa fa-search"></i></button>
        </form>
    </div>

    <?php if(empty($dialogs)): ?>

            <div style="padding-top: 100px;">Вы еще ни с кем не переписывались</div>

    <?php endif ?>

    <?php Pjax::begin();?>

        <?= Html::a(
            'Обновить',
            ['/messages'],
            [
                'class' => 'hide btn btn-lg btn-primary',
                'id' => 'refreshButton',
                'style' => 'display:none'
            ]
        )?>

        <div class="messages__blocks">

            <?php foreach($dialogs as $dialog): ?>

                <?= $this->render('_dialog',[
                    'dialog' => $dialog,
                    'user' => $user,
                    'users' => $users,
                ])?>

            <?php endforeach ?>

        </div>

    <?php Pjax::end();?>

</div>

<?= \app\widgets\NotificationColumn::widget() ?>


