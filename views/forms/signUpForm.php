<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>

<?php $form = ActiveForm::begin([
    'id' => 'sign-up-form',
    'options' => [
        'class' => 'tg-formtheme tg-formregister'
    ],
    'fieldConfig' => [
//        'template' => "{input}\n{error}",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
        'errorOptions' => ['style' => 'margin:0px auto;']
    ],

]); ?>
    <fieldset>

        <?= $form->field($signUpFormModel, 'username',[
            'options' => [
                'class' => 'form-group tg-inputwithicon',
            ],
            'template' => "<i class=\"icon-user\"></i>{input}\n{error}",
        ])->textInput([
            'placeholder' => "Enter Your Username",
            'autofocus' => false,
        ]) ?>

        <?= $form->field($signUpFormModel, 'email',[
            'options' => [
                'class' => 'form-group tg-inputwithicon',
            ],
            'template' => "<i class=\"icon-envelope\"></i>{input}\n{error}",
        ])->textInput([
            'placeholder' => "Enter Your Email",
            'autofocus' => false,
        ]) ?>

        <?= $form->field($signUpFormModel, 'password',[
            'options' => [
                'class' => 'form-group tg-inputwithicon',
            ],
            'template' => "<i class=\"icon-lock\"></i>{input}\n{error}",
        ])->passwordInput([
            'placeholder' => "Enter Password",
            'autofocus' => false,
        ]) ?>

<!--       //= $form->field($signUpFormModel, 'repeatPassword',[
//            'options' => [
//                'class' => 'form-group tg-inputwithicon',
//            ],
//            'template' => "<i class=\"icon-lock\"></i>{input}\n{error}",
//        ])->passwordInput([
//            'placeholder' => "Repeat Password",
//            'autofocus' => false,
//        ])  -->

        <?= $form->field($signUpFormModel, 'confirmTerms')->checkbox([
            'id' => 'confirmTerms',
            'label' => 'Регистрируясь, я соглашаюсь с <a href="javascript:void(0);">Условиями использования</a>',
            'template' => "<div class='tg-checkbox'>{input} <label for='confirmTerms'>{label}</label>\n{error}</div>",
        ]) ?>

        <?= Html::submitButton('Зарегистрировать', ['class' => 'tg-btn', 'name' => 'sign-up-button']) ?>

    </fieldset>

<?php ActiveForm::end(); ?>

