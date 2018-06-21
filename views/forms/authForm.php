<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => [
        'class' => 'tg-formtheme tg-formloging'
    ],
    'fieldConfig' => [
        'template' => "{input}\n{error}",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
        'errorOptions' => ['style' => 'margin:0px auto;']
    ],

]); ?>

    <fieldset>

        <?= $form->field($authFormModel, 'username')->textInput(['autofocus' => false]) ?>

        <?= $form->field($authFormModel, 'password')->passwordInput() ?>

        <?= $form->field($authFormModel, 'rememberMe')->checkbox([
            'id' => 'rememberMe',
            'label' => 'Запомнить меня',
            'template' => "<div class='tg-checkbox'>{input} <label for='rememberMe'>{label}</label>\n{error}</div><a href='' class='tg-forgetpassword'>Забыли пароль?</a>",
        ]) ?>

        <?= Html::submitButton('Войти', ['class' => 'tg-btn', 'name' => 'login-button']) ?>

    </fieldset>

<?php ActiveForm::end(); ?>