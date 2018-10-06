<?php

use yii\widgets\ActiveForm;

$script = <<< JS

$('#age_max, #age_min, #city_id').on('change', function() {
    $('#user-search-form').click();
});

JS;

$this->registerJs($script, \yii\web\View::POS_READY);

?>

<?php $form = ActiveForm::begin([
    'action' => $model->action,
]); ?>

<div class="people__sidebar">

    <?= $form->field($model,'name')->hiddenInput()->label(false); ?>

    <div class="people__city-chose">
        <?= $form->field($model, 'city_id')->dropDownList(
            \app\models\City::find()->select('name')->indexBy('id')->column()
        , [
            'id' => 'city_id',
            'prompt' => 'Выберите город',
            'class' => 'people__city-list',
        ])->label(false);?>
    </div>
    <div class="people__age-chose">
        Возраст

        <?php
        $arrayAgeMin = [];
        for($i = $model->age_min_default; $i <= $model->age_max; $i++) { $arrayAgeMin[$i] = $i;}

         $form->field($model, 'age_min')->dropDownList(
            $arrayAgeMin
            , [
            'id' => 'age_min',
            'prompt' => 'от',
            'class' => 'people__age',
        ])->label(false);
        ?>
        -
        <?php
            $arrayAgeMax = [];
            for($i = $model->age_min; $i <= $model->age_max_default; $i++) { $arrayAgeMax[$i] = $i;}

             $form->field($model, 'age_max')->dropDownList(
                $arrayAgeMax
                , [
                'id' => 'age_max',
                'prompt' => 'до',
                'class' => 'people__age',
            ])->label(false);
        ?>
    </div>
</div>

<button id="user-search-form" style="display: none;"></button>
<?php ActiveForm::end(); ?>
