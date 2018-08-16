<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить пользоват', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'username',
            'name',
            'second_name',
            'email:email',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            //'email_confirm_token:email',
            //'email:email',
            [
                'label' => 'status',
                'filter' => function($model) {
                  return $model::getStatusesArray();
                },
                'value' => function($model){
                    return $model->status;
                }
            ],
            'created_at:date',
            //'updated_at',
            //'online_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
