<?php

if($exchange['type_no'] == 2)
    $this->title = 'Planet|' . $exchange['abbr'] . '|Rack';
else
    $this->title = 'Planet|' . $exchange['mother_abbr'] .'|'.$exchange['abbr']. '|Rack';


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
                <h5 style="margin:10px;" class="text-center" ><?= $rack['saloon']; ?></h5>
            </div>
        </a>

        <div class=" bg-wt  margin-5  padding-5" style="height: 80px;width:200px; color:darkslateblue;">
            <h4 style="margin:10px; color:#1b3f5f;" class="text-center" >Rack</h4>
            <h5 style="margin:10px;" class="text-center" ><?= 'Row: '.$rack['rack_row'].' Column: '.$rack['rack_column']; ?></h5>
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
    <button onclick="addRackDevice(this)" exch-abbr="<?= $exchange['abbr']; ?>" rack-id="<?= $rack['id']; ?>" rack-row="<?= $rack['rack_row']; ?>" rack-column="<?= $rack['rack_column']; ?>" devices='<?= json_encode($devices); ?>' purchases='<?= json_encode($purchases); ?>' class="btn btn-success" style="display: block; margin:auto;"><i class="fa fa-plus fa-lg"></i> Install New Device </button>
    <br />

<?php $devToolHeight = count($rackDevs)*30; $marginTop = count($rackDevs)*2; ?>
    <div class="rack-div" style="width: <?= (3*$rack['rack_width'])."px"; ?>; height:<?= (3*$rack['rack_height']+30+$devToolHeight+$marginTop)."px"; ?>;; margin:auto; position:relative;">
        <div class="rack-top-bar" style="position: absolute; top:0; height:15px;width:100%; background-color: #2b669a"></div>
        <div class="rack-inside" style='position:absolute;top:15px;margin: 0 auto; width:<?= (3*$rack['rack_width'])."px"; ?>; height:<?= (3*$rack['rack_height']+$devToolHeight+$marginTop)."px"; ?>; background-color: #1b3f5f;color:white '>
            <!--    -->
            <?php
            foreach ($rackDevs as $dev)
            {?>
                <div  style="margin: 0 auto; margin-top:2px;border-left:2px solid white; background-color:#adb5bd;width:<?= (3*$dev['device_width']-2).'px'; ?>; height:<?= (3*$dev['device_height']+30).'px'; ?>;position:relative;">
                    <div class="dev-tools" style="height:30px; width:100%; background-color:snow;">
                        <button title='Remove Device' exch-abbr="<?= $exchange['abbr']; ?>" shelf="<?= $dev['shelf_no']; ?>" rackdevid="<?= $dev['id']; ?>" dev="<?= $dev['device']; ?>" devname="<?= $dev['device_name']; ?>" onclick="removeRackDevice(this)" style="float:left; height:30px;border:none;color:darkred;background-color: transparent;"><i class="fa fa-times" style="height:30px;"></i></button>
                        <button title='Edit Device'  exch-abbr="<?= $exchange['abbr']; ?>" racks='<?= json_encode($racks); ?>'  rack-id="<?= $rack['id']; ?>" shelf="<?= $dev['shelf_no']; ?>" purchase="<?= $dev['purchase']; ?>" purchases='<?= json_encode($purchases); ?>' rackdevid="<?= $dev['id']; ?>" device-id="<?= $dev['device_id']; ?>" devtype="<?= $dev['device_type']; ?>" devices='<?= json_encode($devices); ?>' desc="<?= $dev['description']; ?>" onclick="editRackDevice(this)" style="float:right;height:30px;border:none;color:darkgreen;background-color: transparent;"><i class="fa fa-edit" style="height:30px;"></i></button>
                    </div>
                    <a href="<?= Yii::$app->request->baseUrl.'/rackdev/index?id='.$dev['id'];?>" >
                        <div class="dev-box" title="<?= '[Shelf: '. $dev['shelf_no']."] ".$dev['device_name']; ?>" style="display:table;width:100%; height:<?= (3*$dev['device_height']).'px'; ?>;margin: 0 auto;color:#1b3f5f;">
                            <div style="display: table-cell; vertical-align: middle;">
                                <p class="text-center" style="margin:0; margin-top:2px;font-size: 12px;"><?= $dev['device_type'].'-'.$dev['purchase']; ?></p>
                                <p class="text-center" style="margin:0; margin-top:2px;font-size:14px;"><?= $dev['device']; ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
            <!--    -->
        </div>
        <div class="rack-bottom-bar" style="position: absolute; bottom:0; height:15px;width:100%; background-color:#2b669a;"></div>
    </div>

<?php
require_once("modals/newRackDeviceModal.php");
require_once("modals/removeRackDeviceModal.php");
require_once("modals/editRackDeviceModal.php");

$bPath = Yii::$app->request->baseUrl;
$js = <<< JS
function addRackDevice(obj)
{
    var rack_id = $(obj).attr('rack-id');
    var abbr = $(obj).attr('exch-abbr');
    var rack_row = $(obj).attr('rack-row');
    var rack_column = $(obj).attr('rack-column');
    var devices = $(obj).attr('devices');
    var purchases = $(obj).attr('purchases');
    devices = JSON.parse(devices);
    purchases = JSON.parse(purchases);
    
    $("#newRackDevId").val(rack_id);
    $("#newRackDevAbbr").val(abbr);
    $("#newRackDevRR").val(rack_row);
    $("#newRackDevRC").val(rack_column);
    $("#newRackDevDevices").empty();
    $("#newRackDevPurchases").empty();
    for(var key in devices)
    {
        var o = new Option(devices[key]['type']+"-"+devices[key]['device'], devices[key]['id']);
        $("#newRackDevDevices").append(o);
    }
        for(var key in purchases)
    {
        var o = new Option(purchases[key]['purchase']+"-"+purchases[key]['abbr'], purchases[key]['abbr']);
        $("#newRackDevPurchases").append(o);
    }
    
    $("#newRackDevDevices").val(-1);
    $("#newRackDevPurchases").val(-1);
    $("#newRackDeviceModal").modal('show');
}

function removeRackDevice(obj)
{
    var abbr = $(obj).attr('exch-abbr');
    var shelf = $(obj).attr('shelf');
    var rackdevid = $(obj).attr('rackdevid');
    var dev = $(obj).attr('dev');
    var devname = $(obj).attr('devname');
    
    $("#removeRackDevId").val(rackdevid);
    $("#removeRackDevAbbr").val(abbr);
    $("#removeRackDevShelf").val(shelf);
    $("#removeRackDevDev").val(dev);
    $("#removeRackDevDevName").val(devname);
    
    $("#removeRackDeviceModal").modal('show');
}

function editRackDevice(obj)
{
    var abbr = $(obj).attr('exch-abbr');
    var racks = $(obj).attr('racks');
    racks = JSON.parse(racks); console.log(racks);
    var rack_id = $(obj).attr('rack-id');
    var shelf = $(obj).attr('shelf');
    var rackdevid = $(obj).attr('rackdevid');
    var device_id = $(obj).attr('device-id');
    var purchase = $(obj).attr('purchase');
    var devtype = $(obj).attr('devtype');
    var devices = $(obj).attr('devices');
    var purchases = $(obj).attr('purchases');
    var desc = $(obj).attr('desc');
    devices = JSON.parse(devices);
    purchases = JSON.parse(purchases);
    
    $("#editRackDevId").val(rackdevid);
    $("#editRackDevAbbr").val(abbr);
    $("#editRackDevRack").empty();
        for(var key in racks)
    {
         var o = new Option(racks[key]['saloon']+": "+racks[key]['rack_row']+"-"+racks[key]['rack_column'], racks[key]['id']);
         $("#editRackDevRack").append(o);
    }
    $("#editRackDevShelf").val(shelf);
    $("#editRackDevDesc").val(desc);
    $("#editRackDevDevices").empty();
    $("#editRackDevPurchases").empty();
    for(var key in devices)
    {
        if( devices[key]['type'] == devtype )
            {
               var o = new Option(devices[key]['type']+"-"+devices[key]['device'], devices[key]['id']);
                $("#editRackDevDevices").append(o);   
            }
    }
        for(var key in purchases)
    {
        var o = new Option(purchases[key]['purchase']+"-"+purchases[key]['abbr'], purchases[key]['abbr']);
        $("#editRackDevPurchases").append(o);
    }
    
    $("#editRackDevRack").val(rack_id);
    $("#editRackDevDevices").val(device_id);
    $("#editRackDevPurchases").val(purchase);
    
    $("#editRackDeviceModal").modal('show');
}

JS;
$this->registerJs($js, Yii\web\View::POS_END);
?>