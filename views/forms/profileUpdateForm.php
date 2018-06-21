<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form ActiveForm */

?>
<div class="profile-">

    <?php $form = ActiveForm::begin(); ?>

        <table class="table table-hover" style="text-align:left !important;">
            <thead>
                <th>Личные данные</th>
                <th>Показывать всем</th>
            </thead>
            <tbody>
                <tr>
                    <td><?= $form->field($model, 'name') ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td><?= $form->field($model, 'birthday') ?></td>
                    <td><?= $form->field($model, 'show_birthday')->checkbox() ?></td>
                </tr>
                <tr>
                    <td><?= $form->field($model, 'address') ?></td>
                    <td><?= $form->field($model, 'show_address')->checkbox() ?></td>
                </tr>
                <tr>
                    <td>
                        <?= $form->field($model, 'phone') ?>
                        <?= $form->field($model, 'telegram_on')->checkbox()  ?>
                        <?= $form->field($model, 'viber_on')->checkbox()  ?>
                        <?= $form->field($model, 'whatsapp_on')->checkbox()  ?>
                    </td>
                    <td><?= $form->field($model, 'show_phone')->checkbox() ?></td>
                </tr>
                <tr>
                    <td><?= $form->field($model, 'skype') ?></td>
                    <td><?= $form->field($model, 'show_skype')->checkbox() ?></td>
                </tr>
                <tr>
                    <td><?= $form->field($model, 'city_id') ?></td>
                    <td><?= $form->field($model, 'show_city')->checkbox() ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><?= $form->field($model, 'show_email')->checkbox() ?></td>
                </tr>
            </tbody>
        </table>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- profile-_updateForm -->
