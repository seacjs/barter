<?php
/**
 * Created by PhpStorm.
 * User: sea-c
 * Date: 27.06.2018
 * Time: 17:29
 * @var $model app\models\Profile
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;


?>

<?php Pjax::begin(); ?>

<?php $form = ActiveForm::begin([
    'options' => [
        ['enctype' => 'multipart/form-data'],
        'data-pjax' => false,
        'id' => 'user-change-form',
//        'onchange' => '$("#form-send-button").click();',
//        'oninput' => 'setTimeout(function(){$("#form-send-button").click();console.log("setTimeout")}, 3000)'
    ]
]); ?>


<div class="cab-main__data-block">
    <div class="cab-main__info">
        <div class="cab-main__title">Личные данные</div>
        <div action="">
            <div class="cab-main__field">
                <?= $form->field($model, 'city_id',[
//                    'template' => '{label}{input}{error}{hint}',
//                    'labelOptions' => ['class' => 'cab-main__field-name'],
//                    'inputOptions' => ['class' => 'cab-main__input cab-main__input--city']
                ])->dropDownList(\app\models\City::find()->select(['name'])->indexBy('id')->column()) ?>
            </div>
            <div class="cab-main__field">
                <?= $form->field($model, 'address',[
                    'template' => '{label}{input}{error}{hint}',
                    'labelOptions' => ['class' => 'cab-main__field-name'],
                    'inputOptions' => ['class' => 'cab-main__input cab-main__input--address']
                ]) ?>
            </div>
            <div class="cab-main__field">
                <?= $form->field($model, 'birthday',[
                    'template' => '{label}{input}{error}{hint}',
                    'labelOptions' => ['class' => 'cab-main__field-name'],
                    'inputOptions' => ['class' => 'cab-main__input cab-main__input--birthday']
                ]) ?>
            </div>
            <div class="cab-main__field">
                <?= $form->field($model, 'phone',[
                    'template' => '{label}{input}{error}{hint}',
                    'labelOptions' => ['class' => 'cab-main__field-name'],
                    'inputOptions' => ['class' => 'cab-main__input cab-main__input--phone']
                ]) ?>
            </div>
            <div class="cab-main__social">
                <img src="/images/icons/whatsup.png" alt="">
                <?= $form->field($model, 'whatsapp_on',[
                    'inputOptions' => ['class' => 'cab-main__input cab-main__input--address']
                ])->checkbox(['label'=>'', 'class' => 'cab-main__input']) ?>
                <img src="/images/icons/viber.png" alt="">
                <?= $form->field($model, 'viber_on',[
                    'inputOptions' => ['class' => 'cab-main__input cab-main__input--address']
                ])->checkbox(['label'=>'', 'class' => 'cab-main__input']) ?>
                <img src="/images/icons/telegram.png" alt="">
                <?= $form->field($model, 'telegram_on',[
                    'inputOptions' => ['class' => 'cab-main__input cab-main__input--address']
                ])->checkbox(['label'=>'', 'class' => 'cab-main__input']) ?>
            </div>
            <div class="cab-main__field">
                <?= $form->field($model, 'skype',[
                    'template' => '{label}{input}{error}{hint}',
                    'labelOptions' => ['class' => 'cab-main__field-name'],
                    'inputOptions' => ['class' => 'cab-main__input cab-main__input--skype']
                ]) ?>
            </div>
            <div class="cab-main__field">
                <?= $form->field($model->user, 'email',[
                    'template' => '{label}{input}{error}{hint}',
                    'labelOptions' => ['class' => 'cab-main__field-name'],
                    'inputOptions' => ['class' => 'cab-main__input cab-main__input--skype']
                ]) ?>
            </div>
        </div>
        <?= Html::submitButton('сохранить', [
            'id' => 'form-send-button',
            'class' => 'cab-main__button cab-main__button--password'
            //        'style' => 'display:none;'
        ]) ?>
    </div>
    <div class="cab-main__show">
        <span class="cab-main__show-text">Показать всем</span>
        <?= $form->field($model, 'show_city',[
            'inputOptions' => ['class' => 'cab-main__input']
        ])->checkbox(['label'=>'','class' => 'cab-main__input']) ?>

        <?= $form->field($model, 'show_address',[
            'inputOptions' => ['class' => 'cab-main__input']
        ])->checkbox(['label'=>'','class' => 'cab-main__input']) ?>

        <?= $form->field($model, 'show_birthday',[
            'inputOptions' => ['class' => 'cab-main__input']
        ])->checkbox(['label'=>'','class' => 'cab-main__input']) ?>

        <?= $form->field($model, 'show_phone',[
            'inputOptions' => ['class' => 'cab-main__input']
        ])->checkbox(['label'=>'','class' => 'cab-main__input']) ?>


        <?= $form->field($model, 'show_skype',[
            'inputOptions' => ['class' => 'cab-main__input']
        ])->checkbox(['label'=>'','class' => 'cab-main__input', 'style' => 'margin-top:40px !important;']) ?>

        <?= $form->field($model, 'show_email',[
            'inputOptions' => ['class' => 'cab-main__input']
        ])->checkbox(['label'=>'','class' => 'cab-main__input']) ?>

    </div>

</div>

<?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>

