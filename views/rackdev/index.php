<?php

if($exchange['type_no'] == 2)
    $this->title = 'Planet|' . $exchange['abbr'] . '|'.$device['device'];
else
    $this->title = 'Planet|' . $exchange['mother_abbr'] .'|'.$exchange['abbr']. '|'.$device['device'];


use yii\helpers\Html;
?>
<div style="display: flex; align-items:center; flex-wrap:wrap; justify-content: center; position: sticky; top:0px; background-color:#eee;z-index:10;">

    <a href="<?= Yii::$app->request->baseUrl . '/main/provinces' ?>">
        <div class=" bg-menu  menu-box margin-5 padding-5" style="color:darkslateblue;margin-left:5px;text-align:center; cursor:pointer;">
            <i class="fa fa-home  menu-icon" ></i>
            <p class="menu-title" >Province</p>
        </div>
    </a>

    <a href="<?= Yii::$app->request->baseUrl . '/sitex/exchanges?area=' . $exchange['area']; ?>">
        <div class=" bg-menu  menu-box margin-5 padding-5" style="color:royalblue;margin-left:5px;text-align:center; cursor:pointer;">
            <i class="fa fa-cloud  menu-icon" ></i>
            <?php if ($exchange['area'] > -1) { ?>
                <p  class="menu-title"><?= "Area: ".$exchange['area']; ?></p>
            <?php }else{ ?>
                <p class="menu-title">Iran</p>
            <?php } ?>
        </div>
    </a>

    <?php if($exchange['type_no'] == 3) { ?>
        <a href="<?= Yii::$app->request->baseUrl . '/sitex/exchange?id='.$exchange['mother_id']; ?>">
            <div class=" bg-menu  menu-box margin-5 padding-5" style="color:saddlebrown;margin-left:5px;text-align:center; cursor:pointer;">
                <i class="fa fa-building  menu-icon" ></i>
                <p class="menu-title"><?= $exchange['mother_abbr'] ?></p>
            </div>
        </a>
    <?php } ?>

    <a href="<?= Yii::$app->request->baseUrl . '/log/index'; ?>" style="margin-left:5px;text-align:center; color:blue;">
        <div class=" bg-menu  menu-box margin-5 padding-5" style="color:sienna;">
            <i class="fa fa-history menu-icon"></i>
            <p  class="menu-title">Logs</p>
        </div>
    </a>

    <a href="<?= Yii::$app->request->baseUrl . '/main/logout'; ?>" style="margin-left:5px;text-align:center;">
        <div class="bg-menu menu-box  margin-5 padding-5" style="color:red;">
            <i class="fa fa-sign-out-alt menu-icon"></i>
            <p class="menu-title">Log out</p>
        </div>
    </a>
</div>
<br />
<div style="display: flex; align-items:center; flex-wrap:wrap; justify-content: center;">
    <a href="<?php if($exchange['type_no'] == 3) echo Yii::$app->request->baseUrl . '/sitex/site?id='.$exchange['id']; else echo Yii::$app->request->baseUrl . '/sitex/exchange?id='.$exchange['id']; ?>">
        <div class=" bg-wt  margin-5  padding-5" title="<?= $exchange['name']; ?>" style="height: 80px;width:200px; color:darkslateblue;">
            <?php if($exchange['type_no'] == 3) { ?>
                <h4 style="margin:10px;color:#1b3f5f;" class="text-center" ><?= $exchange['mother_abbr'].' - '.$exchange['abbr']; ?></h4>
            <?php } else { ?>
                <h4 style="margin:10px;color:#1b3f5f;" class="text-center" ><?= $exchange['abbr']; ?></h4>
            <?php } ?>
            <h5 style="margin:10px;" class="text-center" ><?= $exchange['name']; ?></h5>
        </div>
    </a>

    <a href="<?php if($exchange['type_no'] == 3) echo Yii::$app->request->baseUrl . '/sitex/site?id='.$exchange['id']; else echo Yii::$app->request->baseUrl . '/sitex/exchange?id='.$exchange['id']; ?>">
        <div class=" bg-wt  margin-5  padding-5" style="height: 80px;width:200px; color:darkslateblue;">
            <h4 style="margin:10px; color:#1b3f5f;" class="text-center" >Saloon</h4>
            <h5 style="margin:10px;" class="text-center" ><?= $rackdev['saloon']; ?></h5>
        </div>
    </a>

    <a href="<?= Yii::$app->request->baseUrl . '/rack/index?id='.$rackdev['rack_id']; ?>" >
        <div class=" bg-wt  margin-5  padding-5" style="height: 80px;width:200px; color:darkslateblue;">
            <h4 style="margin:10px; color:#1b3f5f;" class="text-center" >Rack</h4>
            <h5 style="margin:10px;" class="text-center" ><?= 'Row: '.$rackdev['rack_row'].' Column: '.$rackdev['rack_column']; ?></h5>
        </div>
    </a>

    <div class=" bg-wt  margin-5  padding-5" style="height: 80px;width:200px; color:darkslateblue;">
        <h4 style="margin:10px; color:#1b3f5f;" class="text-center" >Device</h4>
        <h5 style="margin:10px;" class="text-center" ><?= $device['type'].' '.$device['device']; ?></h5>
    </div>

</div>

<!-- display error message -->
<?php if (Yii::$app->session->hasFlash('error')) { ?>
    <div class="alert alert-danger alert-dismissible fade in text-left" style="width: 95%; max-width: 500px; margin:5px auto;">
        <a href="#" class="close pull-right" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error! </strong><?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php }

// display success message
if (Yii::$app->session->hasFlash('success')) { ?>
    <div class="alert alert-success alert-dismissible fade in text-left" style="width: 95%; max-width: 500px; margin:5px auto;">
        <a href="#" class="close pull-right" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Successful! </strong><?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php } ?>
<br />
<h4 class="text-center" style="color:darkolivegreen;"><?= str_replace(' ', '', $rackdev['device_name']); ?></h4>
<br />
<?= \app\components\DeviceWidget::widget(['device'=>$device, 'dcp'=>$dcp]); ?>