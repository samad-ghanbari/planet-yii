<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ViewInterfaces */

$this->title = $model->int_id;
$this->params['breadcrumbs'][] = ['label' => 'View Interfaces', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="view-interfaces-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->int_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->int_id], [
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
            'int_id',
            'slots_id',
            'devex_id',
            'exchange_id',
            'area_no',
            'area',
            'abbr',
            'exchange',
            'saloon_no',
            'saloon_name',
            'device_id',
            'device',
            'interface_type',
            'shelf',
            'slot',
            'sub_slot',
            'port',
            'interface',
            'pin_id',
            'label',
            'module',
            'peer_abbr',
            'peer_device',
            'peer_interface',
            'peer_label',
            'ether_trunk',
        ],
    ]) ?>

</div>
