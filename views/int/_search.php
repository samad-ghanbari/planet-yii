<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ViewInterfacesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="view-interfaces-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'int_id') ?>

    <?= $form->field($model, 'slots_id') ?>

    <?= $form->field($model, 'devex_id') ?>

    <?= $form->field($model, 'exchange_id') ?>

    <?= $form->field($model, 'area_no') ?>

    <?php // echo $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'abbr') ?>

    <?php // echo $form->field($model, 'exchange') ?>

    <?php // echo $form->field($model, 'saloon_no') ?>

    <?php // echo $form->field($model, 'saloon_name') ?>

    <?php // echo $form->field($model, 'device_id') ?>

    <?php // echo $form->field($model, 'device') ?>

    <?php // echo $form->field($model, 'interface_type') ?>

    <?php // echo $form->field($model, 'shelf') ?>

    <?php // echo $form->field($model, 'slot') ?>

    <?php // echo $form->field($model, 'sub_slot') ?>

    <?php // echo $form->field($model, 'port') ?>

    <?php // echo $form->field($model, 'interface') ?>

    <?php // echo $form->field($model, 'pin_id') ?>

    <?php // echo $form->field($model, 'label') ?>

    <?php // echo $form->field($model, 'module') ?>

    <?php // echo $form->field($model, 'peer_abbr') ?>

    <?php // echo $form->field($model, 'peer_device') ?>

    <?php // echo $form->field($model, 'peer_interface') ?>

    <?php // echo $form->field($model, 'peer_label') ?>

    <?php // echo $form->field($model, 'ether_trunk') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
