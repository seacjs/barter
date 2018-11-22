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
    'action' => $model->action,
]); ?>

    <?= $form->field($model, 'name', [
        'options' => [
            'tag' => false,
        ],
        'template' => '<div class="cab-main__search search">{input}<button class="search__go"><i class="fa fa-search"></i></button></div>',
        'inputOptions' => [

            'template' => '{input}',
            'placeholder' => 'Поиск участника системы',
            'class' => 'search__input',
            'wrapper' => false,

        ],
    ]) ?>

<?php ActiveForm::end(); ?>


