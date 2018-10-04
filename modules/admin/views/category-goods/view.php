<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CategoryGoods */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории товаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'slug',
            'title',
            'description',
            'keywords',
            'h1',
            'left_key',
            'right_key',
            'level',
            'content:ntext',
            'active',
        ],
    ]) ?>

    <p>
        <?= Html::a('Добавить параметр', ['/admin/category-goods/add-option', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= \yii\grid\GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => $model->getOptions(),
            'pagination' => [
                'pageSize' => 100,
            ],
        ]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function($action,  $model,  $key,  $index, $actionColumn) {
                    return \yii\helpers\Url::to(['/admin/category-goods/'.$action.'-option?id='.$model->id]);
//                    return $action.'?id='.$model->id;
                },
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>


</div>
