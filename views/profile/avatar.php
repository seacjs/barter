<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

use app\assets\DublAsset;
//DublAsset::register($this);

?>



<div class="cab-main">

    <!-- chat search-bar begin -->

    <?= \app\widgets\UserSearchWidget::widget()?>

    <div>
        <a href="/profile/upadate">Вернуться к заполнение профиля</a>
    </div>

    <?php $form = ActiveForm::begin([
        'options' => [
            ['enctype' => 'multipart/form-data'],
            'data-pjax' => false,
            'id' => 'user-change-form',
        ]
    ]); ?>

    <?php echo $form->field($fileModel, 'files[]')->widget(\kartik\file\FileInput::class, \app\models\File::initialOptions($fileModel, $user));?>

    <?php ActiveForm::end(); ?>

</div>


<?= \app\widgets\NotificationColumn::widget() ?>
