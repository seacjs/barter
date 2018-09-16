<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductGoods */
/* @var $form yii\widgets\ActiveForm */

$script = <<< JS
$('input[type="radio"]').on('change', function(e) {
    var categoryId = $(this).val();
    var categoryBlock = $(this).parent('.container').parent('.add-goods__category__selector-frame').parent('.add-goods__category');
    var categoryTitle = $(this).parent('.container').parent('.add-goods__category__selector-frame').parent('.add-goods__category').children('.add-goods__category-title').children('.add-goods__region-text');;
    var categoryName = $(this).data('value');
    var nextCategoryBlocks = $(this).parent('.container').parent('.add-goods__category__selector-frame').parent('.add-goods__category').next(".add-goods__category");

    categoryTitle.html(categoryName);
    nextCategoryBlocks.remove();

    $.ajax({
            method: 'post',
            url: '/product/ajax-get-categories',
            data: 'id=' + categoryId,
            success: function(data) {
        categoryBlock.after(data);
        console.log('categoryBlock',categoryBlock);
    }
        });
    });
    $(".fa-angle-down").on("click", function() {
        $(this).parent().next().toggle(50);
    });
JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_READY,'radio-button-change');


?>

<div class="add-goods">

    <div class="search">
        <form action="">
            <input type="text" value="Поиск участника системы" class="search__input">
            <button class="search__go"><i class="fa fa-search"></i></button>
        </form>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <div class="add-goods__title"> <?= $model->isNewRecord ? 'Добавление товара' : 'Редактирование товара' ?></div>
    <div class="add-goods__content">

        <!-- LEFT COLUMN -->
        <div class="add-goods__left-part">


            <?= $form->field($model, 'name')->textInput([
                'maxlength' => true,
                'class' => 'add-goods__name',
                'placeholder' => 'Название'
            ])->label(false) ?>

            <div class="add-goods__discription">
                <?= $form->field($model, 'delivery')->textarea([
                    'rows' => 6,
                    'class' => 'add-goods__discription-text',
                    'id' => 'delivery',
                    'placeholder' => 'информация о доставке'
                ])->label('информация о доставке') ?>
            </div>
            <br>

<!--            --><?php //echo  $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

            <?php if($model->isNewRecord):?>

                <?php echo $this->render('/product/_select', [
                        'modelName' => 'ProductGoods',
                        'model' => $model,
                        'attributeName' => 'category_id',
                        'items' => \app\models\CategoryGoods::find()->select(['name','id'])->where(['level' => 0])->indexBy('id')->column(),
                    ]); ?>


                <?= $form->field($model, 'user_id')->hiddenInput([
                    'value' => $model->isNewRecord ? Yii::$app->user->id : $model->user_id
                ])->label(false)?>

            <?php else: ?>

                <!-- CATEGORY BLOCK -->
                <?= $form->field($model, 'category_id')->textInput([
                    'maxlength' => true,
                    'class' => 'add-goods__name',
                    'placeholder' => 'Категория',
                    'disabled' => 'disabled',
                    'value' => \app\models\CategoryGoods::findOne(['id' => $model->category_id])->name
                ])->label(false) ?>

            <?php endif ?>

            <div class="add-goods__category">
                <div class="add-goods__category-title">
                    <p class="add-goods__region-text">Адрес выдачи</p>
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                </div>

                <?php
                    $modelName = explode('\\', $model::className());
                    $modelName = $modelName[count($modelName)-1];
                    $model->addressRadioButton = ($model->addressRadioButton == 'new' && trim($model->address) == '') ? 'my' : 'new';
                ?>
                <div class="add-goods__region-list">
                    <span><label for="delivery-russia">Мой адрес</label>
                        <div class="label-holder">
                            <label class="container">
                                <input type="radio" name='<?=$modelName?>[addressRadioButton]' value="my" <?=$model->addressRadioButton == true ? 'checked="checked"' : ''?>>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </span>
                    <span><label for="delivery-cities">Новый адрес: </label>
                        <span>
                            <?= $form->field($model, 'address')->label(false)?>
                        </span>
                        <div class="label-holder">
                            <label class="container">
                                <input type="radio" name='<?=$modelName?>[addressRadioButton]' value="new">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </span>
                </div>
            </div>



            <div class="add-goods__discription">
                <?= $form->field($model, 'content')->textarea([
                    'rows' => 6,
                    'class' => 'add-goods__discription-text',
                    'id' => 'example',
                    'placeholder' => 'Описание товара*'
                ])->label('Описание') ?>
            </div>

        </div>

        <!-- RIGHT COLUMN -->
        <div class="add-goods__right-part">
            <div class="add-goods__photo-block">
                <div class="add-goods__photo-title">Выберете фото товара</div>
                <button class="add-goods__photo-button">Загрузить</button>
                <p class="add-goods__photo-text">Максимальный размер 2Mb</p>
                <div class="add-goods__photos">
                    <div class="add-goods__photo">
                        <i class="fa fa-square-o" aria-hidden="true"></i>
                    </div>
                    <div class="add-goods__photo">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                    </div>
                    <div class="add-goods__photo">
                        <i class="fa fa-square-o" aria-hidden="true"></i>
                    </div>
                </div>
            </div>

<!--            <div class="add-goods__price">-->
<!--                <input type="text" class="add-goods__price-text" placeholder="Цена">-->
<!--                <img src="images/icons/bal-blue.png" alt="" class="">-->
<!--            </div>-->

            <?= $form->field($model, 'price', [
                'template' => '<div class="add-goods__price">{label}{input}<img src="/images/icons/bal-blue.png" alt="" class="">{error}{hint}</div>',
            ])->textInput([
                'maxlength' => true,
                'class' => 'add-goods__price-text',
                'placeholder' => 'Цена'
            ])->label(false) ?>



<!--            <input type="text" class="add-goods__input" placeholder="Цена">-->
<!--            <input type="text" class="add-goods__input" placeholder="Характеристика 1">-->
<!--            <input type="text" class="add-goods__input" placeholder="Характеристика 2">-->
<!--            <input type="text" class="add-goods__input" placeholder="Характеристика 3">-->
<!--            <input type="text" class="add-goods__input" placeholder="Доступное количество">-->
<!--            <p class="add-goods__text">Оставьте пустым если нет количественного учета</p>-->



            <?php if(!$model->isNewRecord):?>

                <?= $this->render('_optionsForm', [
                    'form' => $form,
                    'model' => $model,
                    'optionModel' => $optionModel
                ])?>

            <?php endif ?>



            <?= Html::submitButton($model->isNewRecord ? 'Продолжить' : 'Сохранить', ['class' => 'add-goods__save']) ?>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<!-- todo: create Asset -->

<script src="/js/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="/js/sceditor/minified/themes/default.min.css" />
<script src="/js/sceditor/minified/sceditor.min.js"></script>
<script src="/js/sceditor/minified/formats/bbcode.min.js"></script>
<script>
    // Replace the textarea #example with SCEditor
    var textarea = document.getElementById('example');
    var delivery = document.getElementById('delivery');
    sceditor.create(delivery, {
        format: 'bbcode',
        toolbar: 'bold,italic,underline|source',
        style: 'minified/themes/content/default.min.css'
    });
    sceditor.create(textarea, {
        format: 'bbcode',
        toolbar: 'bold,italic,underline|source',
        style: 'minified/themes/content/default.min.css'
    });
</script>
