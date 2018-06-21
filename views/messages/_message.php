<?php

//$headers = \Yii::$app->request->headers;
//$res = $headers->get('cookie');
//echo \yii\helpers\VarDumper::dump($res,10,1);

//$array = \yii\helpers\ArrayHelper::toArray($client);

?>

<div class="message">

    <div class="row">

        <?php if($me):?>
            <div class="col-sm-2"></div>
        <?php endif ?>
        <div class="col-sm-10" style="<?= $me ? 'text-align:right;' : ''?>">
            <code style="display: block;">
                <b><?=$model->userFrom->username?></b>
            </code>
            <code style="display: block;">
                <?=$model->message?>
            </code>
        </div>
        <?php if(!$me):?>
            <div class="col-sm-2"></div>
        <?php endif ?>

    </div>
</div>
