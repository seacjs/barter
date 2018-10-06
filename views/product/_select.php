<?php

$script = <<< JS
console.log('level:',$level);
$('#level-$level input[type="radio"]').on('change', function(e) {
    var categoryId = $(this).val();
    var categoryBlock = $(this).parent('.container').parent('.add-goods__category__selector-frame').parent('.add-goods__category');
    var categoryTitle = $(this).parent('.container').parent('.add-goods__category__selector-frame').parent('.add-goods__category').children('.add-goods__category-title').children('.add-goods__region-text');;
    var categoryName = $(this).data('value');
    var nextCategoryBlocks = $(this).parent('.container').parent('.add-goods__category__selector-frame').parent('.add-goods__category').next(".add-goods__category");

    categoryTitle.html(categoryName);
    nextCategoryBlocks.remove();

    $.ajax({
            method: 'post',
            url: '/product/ajax-get-categories',
            data: 'id=' + categoryId + '&level=' + ($level + 1) ,
            success: function(data) {
        categoryBlock.after(data);
        console.log('categoryBlock',categoryBlock);
    }
        });
    });
    $("#level-$level  .fa-angle-down").on("click", function() {
        $(this).parent().next().toggle(50);
    });
JS;
$this->registerJs($script, yii\web\View::POS_READY,'radio-button-change-'.$level);

?>

<div class="add-goods__category" id="level-<?=$level?>">
    <div class="add-goods__category-title">
        <p class="add-goods__region-text">Выберите категорию</p>
        <i class="fa fa-angle-down" aria-hidden="true"></i>
    </div>
    <div class="add-goods__category__selector-frame">
        <?php foreach($items as $key => $value):?>
            <label class="container">
                <input type="radio" name="<?=$modelName?>[<?=$attributeName?>]" value="<?=$key?>" data-value="<?=$value?>">
                <span class="checkmark"><?=$value?></span>
            </label>
        <?php endforeach ?>
    </div>
</div>


