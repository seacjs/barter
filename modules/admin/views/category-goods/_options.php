<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OptionGoods */
/* @var $categoryModel app\models\CategoryGoods */
/* @var $form yii\widgets\ActiveForm */

$this->title = ($model->isNewRecord ? 'Добавить параметр для категории товара' : 'Изменить параметр для категории товара' ) . ' ' . $categoryModel->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории товаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $categoryModel->name, 'url' => ['view', 'id' => $categoryModel->id]];
$this->params['breadcrumbs'][] = $this->title;

$scriptAjaxAddVariant = <<< JS
    function ajaxAddVariant(modelId) {
    var lastVariants = $('#option-variants').children().last();
    var countVariants = lastVariants.length === 0 ? 1 : (parseInt(lastVariants.data('serial-key')) + 1);
        $.ajax({
            url: "/admin/category-goods/ajax-add-variant/"+countVariants+"?optionGoodsId="+modelId,
            success: function(data) {
                $('#option-variants').append(data);
            },
        });
    };
JS;

$this->registerJs($scriptAjaxAddVariant, yii\web\View::POS_BEGIN, 'ajax-add-variant');

?>

<div class="category-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->hiddenInput([
        'value' => $categoryModel->id
    ])->label(false) ?>

    <?php if($model->isNewRecord):?>
        <?= $form->field($model, 'type')->dropDownList($model->getTypes())?>
    <?php else:?>

        <?= $form->field($model, 'type')->textInput([
            'value' => $model->typeName,
            'disabled' => 'disabled'
        ])?>


        <?php if($model->getIsTypeMulti()):?>

            <div class="form-group">

                <?=\yii\bootstrap\Html::button('Добавить вариант', [
                    'class' => 'btn btn-primary',
                    'onclick' => new \yii\web\JsExpression('ajaxAddVariant('.$model->id.');')
                ])?>

            </div>

            <div id="option-variants">
                <?php foreach($model->optionVariants as $key => $variant):?>

                    <?= $this->render('_optionVariant', [
                        'key' => $key,
                        'model' => $variant,
                        'form' => $form,
                        'optionModel' => $model
                    ])?>

                <?php endforeach ?>
            </div>

        <?php endif?>

    <?php endif?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<!--<h2>Options</h2>-->
<!---->
<!--<button>add option</button>-->
