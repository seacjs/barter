<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductGoods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?php if($model->isNewRecord):?>

        <?= $form->field($model, 'category_id')->dropDownList(\app\models\CategoryGoods::find()->select(['name','id'])->indexBy('id')->column()) ?>

        <?= $form->field($model, 'user_id')->hiddenInput([
            'value' => $model->isNewRecord ? Yii::$app->user->id : $model->user_id
        ])->label(false)?>

    <?php else: ?>

        <?= $form->field($model, 'category_id', [
            'options' => ['disabled' => 'disabled']
        ])->dropDownList(\app\models\CategoryGoods::find()->select(['name','id'])->indexBy('id')->column()) ?>

        <?= $this->render('_optionsForm', [
            'form' => $form,
            'model' => $model,
            'optionModel' => $optionModel
        ])?>

    <?php endif ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
