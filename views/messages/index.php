<?php

//\yii\helpers\VarDumper::dump($dialogs,10,1);

?>

<?php if(empty($dialogs)): ?>

    <div>Вы еще ни с кем не переписывались</div>
    <?php
    $users = \app\models\User::find()
        ->where([
            'not in', 'id', Yii::$app->user->id
        ])->all();
    ?>
    <?php foreach($users as $user):?>

        <div><?=\yii\bootstrap\Html::a($user->username, ['/profile/view/'.$user->id])?></div>

    <?php endforeach ?>

<?php endif ?>





<?php foreach($dialogs as $dialog): ?>

    <?= $this->render('_dialog',[
        'dialog' => $dialog,
        'user' => $user,
        'users' => $users,
    ])?>

    <li>
        <img src="https://www.shareicon.net/data/2016/05/29/772558_user_512x512.png" width="40px" height="40px">
        <b>12.12.12</b>

        <b>12.12.12</b>
    </li>

<?php endforeach ?>

