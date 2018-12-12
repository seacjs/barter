<?php

use yii\widgets\ActiveForm;

?>

<!--<form action="">-->
<!--    <div class="chat__search search">-->
<!---->
<!--        <input type="text" value="Поиск участника системы" class="search__input">-->
<!--        <button class="search__go"><i class="fa fa-search"></i></button>-->
<!---->
<!--    </div>-->
<!--</form>-->

<?php $form = ActiveForm::begin([
    'action' => '/product'
]); ?>

<!--    --><?php //echo $form->field($model, 'name', [
//        'template' => '<div class="cab-main__search search">{input}<button class="search__go"><i class="fa fa-search"></i></button></div>',
//        'inputOptions' => [
//            'template' => '{input}',
//            'placeholder' => 'Поиск',
//            'class' => 'search__input'
//        ],
//    ]) ?>

    <input type="search" name="name" value="" placeholder="Поиск" class="search__input">
    <button class="search__go"><i class="fa fa-search"></i></button>

<?php ActiveForm::end(); ?>


