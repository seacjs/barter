<?php
/**
 * Created by PhpStorm.
 * User: sea-c
 * Date: 16.09.2018
 * Time: 8:28
 */



?>


<div class="add-goods__category">
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


