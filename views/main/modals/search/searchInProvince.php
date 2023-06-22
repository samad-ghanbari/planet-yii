<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

Yii::$app->formatter->nullDisplay = "";
Pjax::begin(['id' => 'sipgw', 'enablePushState' => false]);

?>
<div class="table-responsive">
    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-striped  table-hover text-center'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //'summary'=>'',
        'columns' => [

            //3
            [
                'attribute' => 'area',
                'headerOptions' => ['class' => 'text-center '],
                'contentOptions' => ['class' => 'text-center', 'style' => "vertical-align: middle;"],
            ],
            //4
            [
                'attribute' => 'name',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center', 'style' => "vertical-align: middle;"],
            ],
            //5
            [
                'attribute' => 'abbr',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center', 'style' => "vertical-align: middle;"],
            ],
            //5
            [
                'attribute' => 'type',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center', 'style' => "vertical-align: middle;"],
            ],
            //6
            [
                'attribute' => 'mother_abbr',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center', 'style' => "vertical-align: middle;"],
            ],
            //7
            [
                'attribute' => 'uplink_abbr',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center', 'style' => "vertical-align: middle;"],
            ],
            //8
            [
                'attribute' => 'site_cascade',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center', 'style' => "vertical-align: middle;"],
            ],
            //9
            [
                'attribute' => 'site_node',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center', 'style' => "vertical-align: middle;"],
            ],

            //10
            [
                'attribute' => 'address',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center', 'style' => "vertical-align: middle;"],
            ],
        ],

    ]);

    Pjax::end();
    ?>
</div>