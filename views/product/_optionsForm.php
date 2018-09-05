<?php

/* @var $this yii\web\View */
/* @var $model app\models\ProductGoods */
/* @var $form yii\widgets\ActiveForm */
/* @var $optionModel \yii\base\DynamicModel */

//\yii\helpers\VarDumper::dump($model,10,1);
?>
<?php foreach($model->options as $option): ?>

    <?php if($option->type === $option::TYPE_CHECKBOX): ?>

        <?php echo  $form->field($optionModel, 'option'.$option->id.'')->checkbox(['label' => $option->name])?>

    <?php endif ?>

    <?php if($option->type === $option::TYPE_COLOR): ?>

        <?php echo  $form->field($optionModel, 'option'.$option->id.'')->dropDownList($option::forDropDownList($option->optionVariants), [
            'label' => $option->name,
        ])->label($option->name)?>

    <?php endif ?>

    <?php if($option->type === $option::TYPE_MULTI_CHECKBOX): ?>

        <?php

//            \yii\helpers\VarDumper::dump($optionModel,10,1);
//                $optionModel['option'.$option->id] = [35,36]
        ?>

        <?php echo  $form->field($optionModel, 'option'.$option->id.'')->checkboxList(\yii\helpers\ArrayHelper::map($option->optionVariants, 'id', 'name'), [
            'label' => $option->name,
        ])->label($option->name)?>


    <?php endif ?>

    <?php if($option->type === $option::TYPE_SELECT): ?>

        <?php echo  $form->field($optionModel, 'option'.$option->id.'')->dropDownList(\yii\helpers\ArrayHelper::map($option->optionVariants, 'id', 'name'), [
            'label' => $option->name,
        ])->label($option->name)?>

    <?php endif ?>

    <?php if($option->type === $option::TYPE_STRING): ?>


        <?= $form->field($optionModel, 'option'.$option->id.'')->textInput([
            'maxlength' => true,
            'class' => 'add-goods__input',
            'placeholder' => $option->name
        ])->label(false) ?>

<!--        --><?php //echo  $form->field($optionModel, 'option'.$option->id.'')->textInput(['label' => $option->name])?>

    <?php endif ?>

    <?php if($option->type === $option::TYPE_TEXT): ?>

        <?php echo  $form->field($optionModel, 'option'.$option->id.'')->textarea()->label($option->name)?>

    <?php endif ?>

    <!-- todo: add radiobutton -->


<?php endforeach ?>

