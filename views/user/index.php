<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="people">

    <?php echo \app\widgets\UserSearchWidget::widget()?>

    <div class="people__title">Участники</div>
    <div class="people__content">

        <div class="people__main">
            <?= \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'layout' => "{items}",
                'itemView' => '_list_item',
            ]);?>
        </div>

        <?php echo \app\widgets\UserSearchWidget::widget([
            'template' => 'full'
        ])?>


    </div>
</div>