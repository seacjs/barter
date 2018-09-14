<?php
/**
 * Created by PhpStorm.
 * User: sea-c
 * Date: 07.07.2018
 * Time: 15:41
 */
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
    'action' => '/user',
]); ?>

    <?= $form->field($model, 'name', [
        'template' => '<div class="cab-main__search search">{input}<button class="search__go"><i class="fa fa-search"></i></button></div>',
        'inputOptions' => [
            'template' => '{input}',
            'placeholder' => 'Поиск участника системы',
            'class' => 'search__input'
        ],
    ]) ?>

<?php ActiveForm::end(); ?>


