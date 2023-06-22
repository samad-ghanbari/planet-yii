<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ViewInterfaces */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="view-interfaces-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'int_id')->textInput() ?>

    <?= $form->field($model, 'slots_id')->textInput() ?>

    <?= $form->field($model, 'devex_id')->textInput() ?>

    <?= $form->field($model, 'exchange_id')->textInput() ?>

    <?= $form->field($model, 'area_no')->textInput() ?>

    <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'abbr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exchange')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'saloon_no')->textInput() ?>

    <?= $form->field($model, 'saloon_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'device_id')->textInput() ?>

    <?= $form->field($model, 'device')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interface_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shelf')->textInput() ?>

    <?= $form->field($model, 'slot')->textInput() ?>

    <?= $form->field($model, 'sub_slot')->textInput() ?>

    <?= $form->field($model, 'port')->textInput() ?>

    <?= $form->field($model, 'interface')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pin_id')->textInput() ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'module')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'peer_abbr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'peer_device')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'peer_interface')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'peer_label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ether_trunk')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
