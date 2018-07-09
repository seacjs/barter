<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    th, td {
        text-align: left !important;
    }
</style>
<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?php if($model->isNewRecord): ?>

    <?php else: ?>

        <?= $this->render('_profileFields', [
            'form' => $form,
            'model' => $model->profile
        ])?>

    <?php endif ?>

    <?= $form->field($model, 'role')->dropDownList($model::getChildRolesArray(),[]) ?>

    <?= $form->field($model, 'status')->dropDownList($model::getStatusesArray(),[
        'value' => $model->isNewRecord ? $model::STATUS_NEW : $model->status
    ]) ?>

    <?php if($model->isNewRecord): ?>
        <?= $form->field($model, 'sendEmailToUserWithData')->checkbox() ?>
    <?php endif ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
