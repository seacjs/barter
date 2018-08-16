<?php

/* @var $this yii\web\View */
/* @var $model app\models\OptionVariantGoods */
/* @var $optionModel app\models\OptionGoods */
/* @var $form \yii\bootstrap\ActiveForm */
/* @var $key integer - serial number variant block */


$scriptAjaxRemoveVariant = <<< JS
    function removeVariantBlock(variantKey) {
        $('#variant-'+variantKey).remove();
    }
JS;
$this->registerJs($scriptAjaxRemoveVariant, yii\web\View::POS_BEGIN, 'ajax-remove-variant');
?>

<div class="row variant-block" id="variant-<?=$key?>" data-serial-key="<?=$key?>">
    <div class="col-sm-8">

        <?php if($optionModel->type === $optionModel::TYPE_CHECKBOX): ?>
            <?= $form->field($model, 'value[]', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'value' => $model->value
                ]
            ])->textInput()->label(false)?>
        <?php endif ?>

        <?php if($optionModel->type === $optionModel::TYPE_COLOR): ?>
            <?= $form->field($model, 'value[]', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'value' => $model->value
                ]
            ])->input('color')->label(false); ?>
        <?php endif ?>

        <?php if($optionModel->type === $optionModel::TYPE_MULTI_CHECKBOX): ?>
            <?= $form->field($model, 'value[]', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'value' => $model->value
                ]
            ])->textInput()->label(false)?>
        <?php endif ?>

        <?php if($optionModel->type === $optionModel::TYPE_SELECT): ?>
            <?= $form->field($model, 'value[]', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'value' => $model->value
                ]
            ])->textInput()->label(false)?>
        <?php endif ?>

        <?php if($optionModel->type === $optionModel::TYPE_STRING): ?>
            <?= $form->field($model, 'value[]', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'value' => $model->value
                ]
            ])->textInput()->label(false)?>
        <?php endif ?>

        <?php if($optionModel->type === $optionModel::TYPE_TEXT): ?>
            <?= $form->field($model, 'value[]', [
                'inputOptions' => [
                    'class' => 'form-control',
                    'value' => $model->value
                ]
            ])->textInput()->label(false)?>
        <?php endif ?>

    </div>
    <div class="col-sm-4">
        <?=\yii\bootstrap\Html::button('Удалить вариант', [
            'class' => 'btn btn-danger',
            'onclick' => new \yii\web\JsExpression('removeVariantBlock('.$key.')'),
//            'onclick' => new \yii\web\JsExpression('ajaxRemoveVariant('.$model->id.')')
        ])?>
    </div>
</div>




<!-- for colors -->
<!--<datalist id="rrr">-->
<!--    <option value="ff0000">-->
<!--    <option value="0000ff">-->
<!--    <option value="00ff00">-->
<!--</datalist>-->



