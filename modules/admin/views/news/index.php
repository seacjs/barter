<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create News', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'slug',
            'created_at:datetime',
            //'updated_at',
            //'content:ntext',
            [
                'attribute' => 'active',
                'content' => function($data) {
                    return '<span class="label label-' . ($data->active ? 'success' : 'warning' ) . '">'.($data->active ? 'yes' : 'no' ).'</span>';
                },

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
