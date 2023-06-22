<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
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
<body style="background-color: #efefef;">
  <?php $this->beginBody() ?>

  <div class="wrap">

    <?php
    NavBar::begin(
      [
      'brandLabel' => Html::img('@web/web/images/planet-icon32.png',['style'=>"margin-top:-5px"]),
      'brandUrl' => Yii::$app->homeUrl,
      'options' => ['class' => 'navbar navbar-default'],
      ]);

    echo Nav::widget(
      [
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' =>
        [
          //install
          ['label' => 'Installation', 'url' => "#",
          'items'=>
          [
            ['label' => Html::img('@web/web/images/exch.png',['style'=>"width:16px"]).' Exchange/Site','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "installation")],
            '<li class="divider"></li>',
            ['label' => Html::img('@web/web/images/fiber.png',['style'=>"width:16px"]).' ODF','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "installation")],
            '<li class="divider"></li>',
            ['label' => Html::img('@web/web/images/device.png',['style'=>"width:16px"]).' Device','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "installation")],
            ['label' => Html::img('@web/web/images/card.png',['style'=>"width:16px"]).' Card','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "installation")],
          ]
        ],

        // view
        ['label' => 'View', 'url' => "#",
        'items'=>
        [
          ['label' => Html::img('@web/web/images/purchase.png',['style'=>"width:16px"]).' Purchases','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
          '<li class="divider"></li>',
          ['label' => Html::img('@web/web/images/interface.png',['style'=>"width:16px"]).' Interface Types','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
          ['label' => Html::img('@web/web/images/sfp.png',['style'=>"width:16px"]).' Module','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
          '<li class="divider"></li>',
          ['label' => Html::img('@web/web/images/saloon.png',['style'=>"width:16px"]).' Saloons','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
          '<li class="divider"></li>',
          ['label' => Html::img('@web/web/images/device.png',['style'=>"width:16px"]).' Devices','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
          ['label' => Html::img('@web/web/images/card.png',['style'=>"width:16px"]).' Cards','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
        ]
      ],

      // manage
      ['label' => 'Management', 'url' => "#",

      'items'=>
      [
        ['label' => Html::img('@web/web/images/device.png',['style'=>"width:16px"]).' Device Management','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "management")],
        '<li class="divider"></li>',
        ['label' => Html::img('@web/web/images/fiber.png',['style'=>"width:16px"]).' ODF Management','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "management")],
      ]
    ],

    //plan
    ['label' => 'Plan', 'url' => "#",

    'items'=>
    [
      ['label' => Html::img('@web/web/images/ip.png',['style'=>"width:16px"]).' IPv4 Plan','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
      '<li class="divider"></li>',
      ['label' => Html::img('@web/web/images/dslam.png',['style'=>"width:16px"]).' DSLAM Plan','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
      ['label' => Html::img('@web/web/images/newDslam.png',['style'=>"width:16px"]).' Local New DSLAM Plan','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
      ['label' => Html::img('@web/web/images/newSite.png',['style'=>"width:16px"]).' New Site DSLAM Plan','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
      ['label' => Html::img('@web/web/images/removeDslam.png',['style'=>"width:16px"]).' Remove DSLAM','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
      ['label' => Html::img('@web/web/images/connection.png',['style'=>"width:16px"]).' Connections','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
      ['label' => Html::img('@web/web/images/nas.png',['style'=>"width:16px"]).' BRAS NAS IP','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
      '<li class="divider"></li>',
      ['label' => Html::img('@web/web/images/switch.png',['style'=>"width:16px"]).' Access Single Switch Plan','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
      ['label' => Html::img('@web/web/images/switch2.png',['style'=>"width:16px"]).' Access Double Switch Plan','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
      '<li class="divider"></li>',
      ['label' => Html::img('@web/web/images/sbc.png',['style'=>"width:16px"]).' SBC IP Loopback Plan','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
      '<li class="divider"></li>',
      ['label' => Html::img('@web/web/images/commercial.png',['style'=>"width:16px"]).' Reserve To Comm. Dep','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
      '<li class="divider"></li>',
      ['label' => Html::img('@web/web/images/reserve.png',['style'=>"width:16px"]).' Reserved VLAN','encode'=>false, 'url' => '#'],
      ['label' => Html::img('@web/web/images/reserve.png',['style'=>"width:16px"]).' Reserved VSI','encode'=>false, 'url' => '#'],
      ['label' => Html::img('@web/web/images/reserve.png',['style'=>"width:16px"]).' Reserved PVC','encode'=>false, 'url' => '#'],
      ['label' => Html::img('@web/web/images/reserve.png',['style'=>"width:16px"]).' Reserved RD','encode'=>false, 'url' => '#'],
    ]
  ],

  //report
  ['label' => 'Report', 'url' => "#",

  'items'=>
  [
    ['label' => Html::img('@web/web/images/device.png',['style'=>"width:16px"]).' Device','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
    ['label' => Html::img('@web/web/images/floorplan.png',['style'=>"width:16px"]).' FloorPlan','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
    ['label' => Html::img('@web/web/images/exch.png',['style'=>"width:16px"]).' Site','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
    '<li class="divider"></li>',
    ['label' => Html::img('@web/web/images/interface.png',['style'=>"width:16px"]).' Interfaces','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
    ['label' => Html::img('@web/web/images/fiber.png',['style'=>"width:16px"]).' ODF','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
    '<li class="divider"></li>',
    ['label' => Html::img('@web/web/images/network.png',['style'=>"width:16px"]).' Network Pool','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
    ['label' => Html::img('@web/web/images/subnet.png',['style'=>"width:16px"]).' Subnet Pool','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
    ['label' => Html::img('@web/web/images/ip.png',['style'=>"width:16px"]).' IP Pool','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
    '<li class="divider"></li>',
    ['label' => Html::img('@web/web/images/list.png',['style'=>"width:16px"]).' LOM','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
    '<li class="divider"></li>',
    ['label' => Html::img('@web/web/images/dslam.png',['style'=>"width:16px"]).' DSLAM','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
    ['label' => Html::img('@web/web/images/dslam.png',['style'=>"width:16px"]).' Total DSLAM Plan','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
    '<li class="divider"></li>',
    ['label' => Html::img('@web/web/images/commercial.png',['style'=>"width:16px"]).' Comm Reserved Interfaces','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
  ]
],

//stat
['label' => 'Statistics', 'url' => "#",

'items'=>
[
  ['label' => Html::img('@web/web/images/exch.png',['style'=>"width:16px"]).' Exchange/Site','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
  '<li class="divider"></li>',
  ['label' => Html::img('@web/web/images/device.png',['style'=>"width:16px"]).' Device Count','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
  ['label' => Html::img('@web/web/images/device.png',['style'=>"width:16px"]).' Device Status','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
  '<li class="divider"></li>',
  ['label' => Html::img('@web/web/images/card.png',['style'=>"width:16px"]).' Cards','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
  ['label' => Html::img('@web/web/images/interface.png',['style'=>"width:16px"]).' Ports','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
]
],

//tools
['label' => 'Tools', 'url' => "#",

'items'=>
[
  ['label' => Html::img('@web/web/images/calculator.png',['style'=>"width:16px"]).' Network Calculator','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
  ['label' => Html::img('@web/web/images/assistant.png',['style'=>"width:16px"]).' Network Assitant','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
  ['label' => Html::img('@web/web/images/analyze.png',['style'=>"width:16px"]).' Configuration Analyser','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
  ['label' => Html::img('@web/web/images/ip.png',['style'=>"width:16px"]).' IP Pool Analyser','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
  ['label' => Html::img('@web/web/images/sfp.png',['style'=>"width:16px"]).' Module Analyser','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
]
],

//log
['label' => 'LOGs', 'url' => '#','active'=> (Yii::$app->controller->id == "view")],

//profile
['label' => 'Profile', 'url' => '#','active'=> (Yii::$app->controller->id == "view")],


//help
['label' => 'About', 'url' => "#",

'items'=>
[
  ['label' => Html::img('@web/web/images/help.png',['style'=>"width:16px"]).' About DaNet','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
  ['label' => Html::img('@web/web/images/regex.png',['style'=>"width:16px"]).' Regex Help','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
  ['label' => Html::img('@web/web/images/recommendation.png',['style'=>"width:16px"]).' Recommendation','encode'=>false, 'url' => '#','active'=> (Yii::$app->controller->id == "view")],
]
],
],

]);

echo Nav::widget(
  [
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' =>
    [
      //logout
      ['label' => 'Sign out <i class="fa fa-sign-out-alt text-danger"></i>','encode'=>false, 'url' => ['main/logout'], 'linkOptions' => ['style'=>"color: #c0534f"]],
    ]
  ]
);

NavBar::end();
?>

<div class="container-fluid">
  <?= $content ?>
</div>
</div>

<footer class="footer text-info">
  <div class="container">
    <p style="float:right;">All Rights Reserved</p>
    <p style="float:left;">&copy PlaNet</p>
  </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
