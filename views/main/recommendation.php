<?php
$this->title = 'Planet|Recommendation';
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
$session = Yii::$app->session;
$session->open();
use yii\helpers\Html;
?>
    <h4 class="text-primary text-center">Recommendations</h4>
<?php if (isset($session['user'])) { ?>
    <div style="display: flex; align-items:center; flex-wrap:wrap; justify-content: center;">
        <div class=" bg-wt margin-5  padding-5" style="height: 150px;width:250px;">
            <h5 class="text-center text-color"><i class="fa fa-user icon-color"></i> <?= $session['user']['name'] . " " . $session['user']['lastname']; ?> </h5>
            <hr />
            <h5 class="text-center text-color" style="margin:10px;"><?php if ($session['user']['province_id'] == 0) echo "Iran Privileges";
                else echo $session['user']['province'] . " Province"; ?></h5>
            <?php if ($session['user']['province_id'] > 0) { ?>
                <h5 style="margin:10px;" class="text-center text-color"><?= $session['user']['office'] . " Office"; ?></h5>
            <?php } ?>
        </div>
    </div>

<?php } ?>

    <button onclick="addRecomm()" class="btn btn-success pull-right"><i class="fa fa-plus text-promary"></i> Add New Recommendation</button>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'options'=>['style'=>"background-color:#eee; color:#000;"],
    'columns' =>
    [

        ['attribute' =>'time_stamp',
            'headerOptions' => ['class' => 'bg-success text-center'],
            'contentOptions' => ['class' => 'text-center', 'style'=>"vertical-align: middle;"],
        ],

        ['attribute' =>'recommendation',
            'headerOptions' => ['class' => 'bg-success text-center'],
            'contentOptions' => ['class' => 'text-center', 'style'=>"vertical-align: middle;"],
        ],
    ],
]);

require_once("modals/recommModal.php");
?>