<?php echo $this->render('/forms/profileUpdateForm', [
    'model' => $model,
]); ?>

<?= \app\widgets\NotificationColumn::widget() ?>
