<?php

use \yii\bootstrap\ActiveForm;
use \yii\bootstrap\Html;

?>

<h2>Баллы в системе</h2>

<div class="row">

    <div class="col-sm-6">

        <div class="row">
            <div class="col-sm-6">
                <label for="systemMoneyValue">Баллов в системе сейчас</label>
                <?=Html::input('баллов в системе сейчас', 'systemMoneyValue', $money->value, [
                    'id' => 'systemMoneyValue',
                    'disabled' => 'disabled',
                    'class' => 'form-control'
                ])?>
            </div>
            <div class="col-sm-6">
                <label for="systemMoneyTotal">Баллов в системе всего</label>
                <?=Html::input('баллов в системе всего', 'systemMoneyTotal', $money->total, [
                    'id' => 'systemMoneyTotal',
                    'disabled' => 'disabled',
                    'class' => 'form-control'
                ])?>
            </div>
        </div>

        <hr>

        <?php $form = ActiveForm::begin([

        ])?>

            <?= $form->field($systemMoney, 'operation', [])->dropDownList(
                $systemMoney->getOperationList()
            ) ?>

            <?= $form->field($systemMoney, 'shift', [])?>

            <?= $form->field($systemMoney, 'message', [])->textarea()?>

            <?= Html::button('Произвести операцию с баллами', [
                'class' => 'btn btn-success',
                'type' => 'submit',
            ])?>

        <?php ActiveForm::end()?>

    </div>

    <div class="col-sm-6">
        <h3>Последние операции:</h3>

        <table class="table table-hover">

            <thead>
                <tr>
                    <th>Дата и время</th>
                    <th>Название операции</th>
                    <th>Значение</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach($systemMoneyLog as $log):?>
                    <tr>
                        <td><?=date('Y.m.d H:i:s', $log->created_at)?></td>
                        <td><?=$systemMoney->getOperationList()[$log->operation]?></td>
                        <td><?=$log->value?></td>
                    </tr>
                <?php endforeach;?>

            </tbody>

        </table>

        <div>
            Показаны последние 10 операций. <a href="/admin/money/systemmoneylog">перейти к просмотру всех</a>
        </div>

    </div>

</div>

<hr>

<h2>Бонусы и начичления</h2>
