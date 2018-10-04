<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории услуг';
$this->params['breadcrumbs'][] = $this->title;

//\yii\helpers\VarDumper::dump(\app\models\Category::find()->all(),10,1);die;

?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить категорию услуг', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php echo \seacjs\nestedsets\widgets\FancytreeWidget::widget([
        'url' =>'/admin/category-service/',
        'options' => [
            'source' => $categories,
            'extensions' => [
                'dnd',
                'table'
            ],
            'dnd' => [
                'preventVoidMoves' => true,
                'preventRecursiveMoves' => true,
                'autoExpandMS' => 400,
                'dragStart' => new JsExpression('function(node, data) {
                return true;
            }'),
                'dragEnter' => new JsExpression('function(node, data) {
                return true;
            }'),
//                'dragDrop' => new JsExpression('function(node, data) {
//                    data.otherNode.moveTo(node, data.hitMode);
//                    $.ajax({
//                        method: "post",
//                        url: "/category/nested-sets-change",
//                        data: "id="+data.otherNode.key+"&id_near="+node.key+"&hit_mode="+data.hitMode,
//                        success: function(data) {
//                            console.log(data);
//                        },
//                    });
//                    console.log(data.otherNode.key); // move node
//                    console.log(data.hitMode); // before, after, over(insert into)
//                    console.log(node.key); // to this node
//                    //console.log("111111111111111111111111111111111111111");
//            }'),
            ],
        ]
    ]); ?>

</div>
