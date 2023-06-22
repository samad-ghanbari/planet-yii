<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Planet|Login';
?>


<?= Html::img('@web/web/images/planet.png', ['style' => "width:90%; max-width:300px; margin:auto; display:block;"]); ?>
<!-- display error message -->
<?php if (Yii::$app->session->hasFlash('error')) : ?>
  <div class="alert alert-danger alert-dismissible fade in text-left" style="width: 95%; max-width: 500px; margin:5px auto;">
    <a href="#" class="close pull-right" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error! </strong><?= Yii::$app->session->getFlash('error') ?>
  </div>
<?php endif; ?>
<div class="row" style="width:100%; padding:5px;">

  <div class="col col-md-3">
    <?= Html::img('@web/web/images/planet-icon.png', ['style' => "width:90%; max-width:200px; margin:auto; display:block;"]); ?>
  </div>

  <div class="col col-md-6" >
      <hr />
      <h4 class="text-center" style="color:darkblue;">Login</h4>
      <?php $form = ActiveForm::begin(['options' => ['style' => "width:90%; max-width:300px; margin:auto; display:block;"]]); ?>

      <?= $form->field($model, 'national_id', ['labelOptions' => ['style' => 'color:darkblue;'], 'errorOptions' => ['class' => 'text-danger']])->textInput(['placeholder' => "Enter your national ID"]); ?>
      <?= $form->field($model, 'password', ['labelOptions' => ['style' => 'color:darkblue;'], 'errorOptions' => ['class' => 'text-danger']])->passwordInput(['placeholder' => "Enter your password"]); ?>

      <div class="form-group" style="width:100px;margin:auto;">
        <br />
        <button type="submit" class="btn btn-info"><i class="fa fa-sign-in-alt text-white"></i> Sign in</button>
      </div>
      <?php ActiveForm::end(); ?>
      <br />

  </div>

  <div class="col col-md-3">
    <?= Html::img('@web/web/images/tci.png', ['style' => "width:90%; max-width:200px; margin:auto; display:block;"]); ?>
  </div>

</div>