<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'second_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList($model::getStatusesArray(), [
        'value' => $model->isNewRecord ? $model::STATUS_NEW : $model->status
    ]) ?>

    <?php if(Yii::$app->user->can('superAdmin')):?>
        <?= $form->field($model, 'role')->dropDownList($model::getChildRolesArray()) ?>
    <?php else:?>
        <?= $form->field($model, 'role')->hiddenInput([
            'value' => Yii::$app->authManager->getRole('user')->name
        ])->label(false) ?>
    <?php endif?>

    <?php if($model->isNewRecord):?>
        <?= $form->field($model, 'email') ?>
    <?php endif?>

    <!-- profile start -->
    <?php if(!$model->isNewRecord):?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model->profile, 'city_id')->dropDownList(\app\models\City::find()->select(['name','id'])->indexBy('id')->column()) ?>
        </div>
        <div class="col-sm-6"><?= $form->field($model->profile, 'show_city')->checkbox() ?></div>
        <div class="clearfix"></div>

        <div class="col-sm-6">
            <?= $form->field($model->profile, 'address') ?>
        </div>
        <div class="col-sm-6"><?= $form->field($model->profile, 'show_address')->checkbox() ?></div>
        <div class="clearfix"></div>

        <div class="col-sm-6">
            <?= $form->field($model->profile, 'birthday') ?>
        </div>
        <div class="col-sm-6"><?= $form->field($model->profile, 'show_birthday')->checkbox() ?></div>
        <div class="clearfix"></div>

        <div class="col-sm-6">
            <?= $form->field($model->profile, 'phone') ?>
            <img src="/images/icons/whatsup.png" alt="">
            <?= $form->field($model->profile, 'whatsapp_on')->checkbox() ?>
            <img src="/images/icons/viber.png" alt="">
            <?= $form->field($model->profile, 'viber_on')->checkbox() ?>
            <img src="/images/icons/telegram.png" alt="">
            <?= $form->field($model->profile, 'telegram_on')->checkbox() ?>
        </div>
        <div class="col-sm-6"><?= $form->field($model->profile, 'show_phone')->checkbox() ?></div>
        <div class="clearfix"></div>

        <div class="col-sm-6">
            <?= $form->field($model->profile, 'skype') ?>
        </div>
        <div class="col-sm-6"><?= $form->field($model->profile, 'show_skype')->checkbox() ?></div>
        <div class="clearfix"></div>

        <div class="col-sm-6">
            <?= $form->field($model, 'email') ?>
        </div>
        <div class="col-sm-6"><?= $form->field($model->profile, 'show_email')->checkbox() ?></div>
        <div class="clearfix"></div>
    </div>
    <!-- profile end -->
    <?php endif?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
















