<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ViewInterfaces */

$this->title = 'Update View Interfaces: ' . $model->int_id;
$this->params['breadcrumbs'][] = ['label' => 'View Interfaces', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->int_id, 'url' => ['view', 'id' => $model->int_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="view-interfaces-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
