<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ViewInterfaces */

$this->title = 'Create View Interfaces';
$this->params['breadcrumbs'][] = ['label' => 'View Interfaces', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="view-interfaces-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
