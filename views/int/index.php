<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ViewInterfacesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'View Interfaces';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="view-interfaces-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create View Interfaces', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'int_id',
            'slots_id',
            'devex_id',
            'exchange_id',
            'area_no',
            //'area',
            //'abbr',
            //'exchange',
            //'saloon_no',
            //'saloon_name',
            //'device_id',
            //'device',
            //'interface_type',
            //'shelf',
            //'slot',
            //'sub_slot',
            //'port',
            //'interface',
            //'pin_id',
            //'label',
            //'module',
            //'peer_abbr',
            //'peer_device',
            //'peer_interface',
            //'peer_label',
            //'ether_trunk',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
