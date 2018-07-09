<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Region */
/* @var $searchModel app\models\RegionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'] = [];
$this->params['breadcrumbs'][] = ['label' => 'Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-view">

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
        ],
    ]) ?>

    <?= $this->render('/city/index', [
        'showRegion' => false,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);?>

</div>
