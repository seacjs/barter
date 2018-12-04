<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

// use app\assets\CropAsset;
// CropAsset::register($this);

$script = <<< JS

    // var setMainImage = function(id) {
    //
    //     var formData = new FormData(document.forms.emptyform);
    //     var xhr = new XMLHttpRequest();
    //     xhr.open("POST", "/partner/offer/ajaxsetmainimage?id="+id, false);
    //     xhr.send(formData);
    //     var sendResult;
    //     if(xhr.status == 200) {
    //         var sendResult = JSON.parse(xhr.responseText);
    //         sendResult = JSON.parse(sendResult);
    //         console.log(sendResult);
    //         if(sendResult.error == false) {
    //             $("#refreshImagesButton").click();
    //         }
    //     }
    // };

    var loadFile = function() {
        var formData = new FormData(document.forms.sendfiles);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/profile/file-upload", false);
        xhr.send(formData);
        var sendResult;
        if(xhr.status == 200) {
          
            var sendResult = JSON.parse(xhr.responseText);

            console.log('sendResult:',sendResult.initialPreview[0]);
            if(sendResult.initialPreview[0] !== undefined) {
                $('#new-avatar').attr('src',sendResult.initialPreview[0].replace('images','crop'));
                setTimeout(function() {
            
                   
                }, 1000);
            }
            if(sendResult.error == false) {}
        }
    };

JS;

$this->registerJs($script, \yii\web\View::POS_HEAD);

?>

<div class="cab-main">

    <!-- chat search-bar begin -->

    <?= \app\widgets\UserSearchWidget::widget()?>

    <div>
        <a href="/profile/upadate">Вернуться к заполнение профиля</a>
    </div>

    <hr>

    <?php $form = ActiveForm::begin([
        'options' => [
            [
                'method' => 'post',
                'enctype' => 'multipart/form-data'
            ],
            'data-pjax' => false,
            'id' => 'sendfiles',
        ]
    ]); ?>

<!--    --><?php //echo $form->field($fileModel, 'files[]')->widget(\kartik\file\FileInput::class, \app\models\File::initialOptions($fileModel, $user));?>


    <?php echo $form->field($fileModel, 'files')->widget(\karpoff\icrop\CropImageUpload::className())?>

    <input type="hidden" value="<?=$user::className()?>" name="model">
    <input type="hidden" value="user" name="component">
    <input type="hidden" value="false" name="multiple">
    <input type="hidden" value="<?=$user->id?>" name="component_id">



    <?php ActiveForm::end(); ?>

    <div>
        <?=\yii\bootstrap\Html::submitButton('Сохранить', [
            'class' => '',
            'onclick' => 'loadFile()',
            'style' => 'background: #fff; border-radius: 6px;display:inline-block;padding:6px 15px;',
        ])?>
    </div>

    <div style="width: 300px; height: auto;">
        <img id="new-avatar" src="" alt="" style="max-width: 100%;z-index: 0;border: solid 1px #000;">
    </div>


</div>

<?= \app\widgets\NotificationColumn::widget() ?>
