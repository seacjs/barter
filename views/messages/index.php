<?php

//\yii\helpers\VarDumper::dump($dialogs,10,1);
use yii\widgets\Pjax;
use yii\bootstrap\Html;



?>

<?php if(empty($dialogs)): ?>

    <div>Вы еще ни с кем не переписывались</div>

<?php endif ?>





<?php Pjax::begin();?>

<?= Html::a(
    'Обновить',
    ['/messages'],
    ['class' => 'hide btn btn-lg btn-primary', 'id' => 'refreshButton']
)?>

<?php foreach($dialogs as $dialog): ?>

    <?= $this->render('_dialog',[
        'dialog' => $dialog,
        'user' => $user,
        'users' => $users,
    ])?>

<?php endforeach ?>

<?php Pjax::end();?>
