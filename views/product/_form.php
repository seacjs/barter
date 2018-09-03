<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductGoods */
/* @var $form yii\widgets\ActiveForm */
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

<!--            --><?php //echo  $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

            <?php if($model->isNewRecord):?>

                <div class="add-goods__category">
                    <div class="add-goods__category-title">
                        <input type="text" class="add-goods__region-text" placeholder="Выберите категорию">
                        <i class="fa fa-angle-down" id='button' aria-hidden="true"></i>
                    </div>
                    <?= $form->field($model, 'category_id')->dropDownList(\app\models\CategoryGoods::find()->select(['name','id'])->indexBy('id')->column(),[
                        'class' => 'add-goods__category-list'
                    ])->label(false) ?>

<!--                    <select multiple class="add-goods__category-list">-->
<!--                        <option value='' class="add-goods__category-item">Мода, личные вещи</option>-->
<!--                        <option value='' class="add-goods__category-item">Товары для детей</option>-->
<!--                        <option value='' class="add-goods__category-item">Товары для дома и дачи</option>-->
<!--                        <option value='' class="add-goods__category-item">Электронная техника</option>-->
<!--                        <option value='' class="add-goods__category-item">Мобильные устройства</option>-->
<!--                    </select>-->
                </div>
                <?= $form->field($model, 'user_id')->hiddenInput([
                    'value' => $model->isNewRecord ? Yii::$app->user->id : $model->user_id
                ])->label(false)?>
            <?php else: ?>

                <?= $form->field($model, 'category_id')->textInput([
                    'maxlength' => true,
                    'class' => 'add-goods__name',
                    'placeholder' => 'Категория',
                    'disabled' => 'disabled',
                    'value' => \app\models\CategoryGoods::findOne(['id' => $model->category_id])->name
                ])->label(false) ?>

            <?php endif ?>



<!---->
<!--            <div class="add-goods__category">-->
<!--                <div class="add-goods__category-title">-->
<!--                    <input type="text" class="add-goods__region-text" placeholder="Регион доставки">-->
<!--                    <i class="fa fa-angle-down" aria-hidden="true"></i>-->
<!--                </div>-->
<!--                <div class="add-goods__region-list">-->
<!--                    <div><label for="delivery-russia">По всей России</label><input type="checkbox" id='region-all-russia' name='delivery-russia'></div>-->
<!--                    <div><label for="delivery-cities">Города: </label><span><input type="text"><input name='delivery-cities' type="checkbox"></span></div>-->
<!--                </div>-->
<!--            </div>-->

<!---->
<!--            <div class="add-goods__category">-->
<!--                <div class="add-goods__category-title">-->
<!--                    <input type="text" class="add-goods__region-text" placeholder="Адрес выдачи">-->
<!--                    <i class="fa fa-angle-down" aria-hidden="true"></i>-->
<!--                </div>-->
<!--                <div class="add-goods__region-list">-->
<!--                    <div><label for="delivery-russia">Мой адрес</label><input type="checkbox" id='region-all-russia' name='delivery-russia'></div>-->
<!--                    <div><label for="delivery-cities">Новый адрес: </label><span><input type="text"><input name='delivery-cities' type="checkbox"></span></div>-->
<!--                </div>-->
<!--            </div>-->


<!--            <div class="add-goods__category">-->
<!--                <div class="add-goods__category-title">-->
<!--                    <input type="text" class="add-goods__region-text" placeholder="Выберите категорию">-->
<!--                    <i class="fa fa-angle-down" id='button' aria-hidden="true"></i>-->
<!--                </div>-->
<!--                <select multiple class="add-goods__category-list">-->
<!--                    <option value='' class="add-goods__category-item">Мода, личные вещи</option>-->
<!--                    <option value='' class="add-goods__category-item">Товары для детей</option>-->
<!--                    <option value='' class="add-goods__category-item">Товары для дома и дачи</option>-->
<!--                    <option value='' class="add-goods__category-item">Электронная техника</option>-->
<!--                    <option value='' class="add-goods__category-item">Мобильные устройства</option>-->
<!--                </select>-->
<!--            </div>-->
<!---->
<!---->
<!--            <div class="add-goods__category">-->
<!--                <div class="add-goods__category-title">-->
<!--                    <input type="text" class="add-goods__region-text" placeholder="Выберите подкатегорию">-->
<!--                    <i class="fa fa-angle-down" id='button' aria-hidden="true"></i>-->
<!--                </div>-->
<!--                <select id='selector' multiple class="add-goods__category-list">-->
<!--                    <option value='' class="add-goods__category-item">Ремонт и строительство</option>-->
<!--                    <option value='' class="add-goods__category-item">Мебель и интерьер</option>-->
<!--                    <option value='' class="add-goods__category-item">Бытовая техника</option>-->
<!--                    <option value='' class="add-goods__category-item">Продукты питания</option>-->
<!--                    <option value='' class="add-goods__category-item">Посуда и товары для кухни</option>-->
<!--                    <option value='' class="add-goods__category-item">Растения</option>-->
<!--                    <option value='' class="add-goods__category-item">Удобрения</option>-->
<!--                    <option value='' class="add-goods__category-item">Прочее</option>-->
<!--                </select>-->
<!--            </div>-->

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
<script>
    let button = document.getElementById('button');
    let selector = document.getElementById('selector');
    $(".fa-angle-down").on("click", function() {
        console.log('click');
        $(this).parent().next().toggle();
    });
</script>
<link rel="stylesheet" href="/js/sceditor/minified/themes/default.min.css" />
<script src="/js/sceditor/minified/sceditor.min.js"></script>
<script src="/js/sceditor/minified/formats/bbcode.min.js"></script>
<script>
    // Replace the textarea #example with SCEditor
    var textarea = document.getElementById('example');
    sceditor.create(textarea, {
        format: 'bbcode',
        toolbar: 'bold,italic,underline|source',
        style: 'minified/themes/content/default.min.css'
    });
</script>