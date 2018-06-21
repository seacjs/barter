<?php

/* @var $this yii\web\View */

$this->title = 'My Super Application';


?>
<main id="tg-main" class="tg-main tg-haslayout">
    <div class="container">
        <p>
            <strong>Вы успешно авторизованы</strong>
        </p>
        <div>
            <?php
                $users = \app\models\User::find()
                    ->where([
                        'not in', 'id', [Yii::$app->user->id]
                    ])->all();
            ?>
            <?php foreach($users as $user):?>

                <div><?=\yii\bootstrap\Html::a($user->username, ['/profile/view/'.$user->id])?></div>

            <?php endforeach ?>
        </div>
    </div>
</main>