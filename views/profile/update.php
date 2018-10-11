
<?php echo $this->render('/forms/profileUpdateForm', [
    'model' => $model,
    'fileModel' => $fileModel
]); ?>

<?= \app\widgets\NotificationColumn::widget() ?>
