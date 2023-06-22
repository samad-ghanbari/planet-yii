
<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

<div class="wrap" >
    <?= $content ?>
</div>

<footer class="footer text-info" style="height:100px; margin-top:20px;">
    <div class="container">
        <div style="float:left; font-size: 12px;">
            <p>Developer Contact:  Ghanbari.Samad@Gmail.com</p>
            <p>All rights reserved&copy</p>
        </div>

        <div style="float: right;font-size: 12px;">
            <a target="_blank" href="<?= Yii::$app->request->baseUrl.'/main/regex_help'; ?>" class="text-info " ><?= Html::img('@web/web/images/regex.png',['style'=>"width:24px"]) ?> Regex Help</a>
            <br style="margin:10px;" />
            <a target="_blank" href="<?= Yii::$app->request->baseUrl.'/main/recommendation'; ?>" class="text-info "><?= Html::img('@web/web/images/recommendation.png',['style'=>"width:24px"]) ?> Recommendation</a>
        </div>
    </div>
</footer>

<?php $this->endBody();
?>
</body>
</html>
<?php $this->endPage() ?>
