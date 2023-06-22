<?php
$session = Yii::$app->session;
$session->open();
$area = -1;
if (isset($session['exchange']))
{
    $this->title = 'Planet|' . $session['exchange']['abbr'] . ' Saloons';
    $area = $session['exchange']['area'];
}
else
    $this->title = 'Planet|Saloons';

use app\models\ObjectsTemplate;
use yii\helpers\Html;

if (isset($session['user'])) { ?>
    <div style="display: flex; align-items:center; flex-wrap:wrap; justify-content: center; position: sticky; top:0px; background-color:#eee;z-index:10;">

        <a href="<?= Yii::$app->request->baseUrl . '/main/provinces' ?>">
            <div class=" bg-menu  menu-box margin-5 padding-5" style="color:darkslateblue;margin-left:5px;text-align:center; cursor:pointer;">
                <i class="fa fa-home  menu-icon" ></i>
                <p class="menu-title" >Province</p>
            </div>
        </a>

        <a href="<?= Yii::$app->request->baseUrl . '/sitex/exchanges?area=' . $area; ?>">
            <div class=" bg-menu  menu-box margin-5 padding-5" style="color:royalblue;margin-left:5px;text-align:center; cursor:pointer;">
                <i class="fa fa-cloud  menu-icon" ></i>
                <?php if ($area > -1) { ?>
                    <p  class="menu-title"><?= "Area: ".$area; ?></p>
                <?php }else{ ?>
                    <p class="menu-title">Iran</p>
                <?php } ?>
            </div>
        </a>

        <a href="<?= Yii::$app->request->baseUrl . '/sitex/sites?exchId=' . $session['exchange']['id']; ?>" style="margin-left:5px;text-align:center;">
            <div class=" bg-menu  menu-box margin-5 padding-5" style="color:purple;">
                <i class="fa fa-sitemap menu-icon"></i>
                <p class="menu-title"><?= $session['exchange']['abbr']." Sites"; ?></p>
            </div>
        </a>

        <a href="<?= Yii::$app->request->baseUrl . '/stat/index'; ?>" style="margin-left:5px;text-align:center; color:#0000ff;">
            <div class=" bg-menu menu-box  margin-5 padding-5">
                <i class="fa fa-table text-primary menu-icon"></i>
                <p class="text-primary menu-title">Table View</p>
            </div>
        </a>

        <a href="<?= Yii::$app->request->baseUrl . '/log/index'; ?>" style="margin-left:5px;text-align:center;">
            <div class=" bg-menu  menu-box margin-5 padding-5" style="color:lightseagreen;">
                <i class="fa fa-drafting-compass menu-icon"></i>
                <p class="menu-title">Plan</p>
            </div>
        </a>

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

        <div class=" bg-wt  margin-5  padding-5" style="height: 150px;width:200px; color:saddlebrown">
            <i class="fa fa-building fa-2x " style=" display:block; margin:auto;"></i>
            <hr />
            <?php if (isset($session['exchange']['abbr'])) { ?>
                <h5 style="margin:10px;" class="text-center"><?= $session['exchange']['abbr']; ?></h5>
                <a class="hvr-bounce-in" eid="<?= $session['exchange']['id']; ?>" earea="<?= $session['exchange']['area']; ?>" ename="<?= $session['exchange']['name']; ?>" eabbr="<?= $session['exchange']['abbr']; ?>" etype="<?= $session['exchange']['type']; ?>" eaddr="<?= $session['exchange']['address']; ?>" onclick="editExchange(this)" style="width: 100px; display:block; margin:auto;text-align:center; color:darkgreen; cursor:pointer;"><i class="fa fa-edit"></i> Edit</a>
                <a class="hvr-bounce-in" eid="<?= $session['exchange']['id']; ?>" earea="<?= $session['exchange']['area']; ?>" ename="<?= $session['exchange']['name']; ?>" eabbr="<?= $session['exchange']['abbr']; ?>" etype="<?= $session['exchange']['type']; ?>" eaddr="<?= $session['exchange']['address']; ?>" onclick="removeExchange(this)" style="width: 100px; display:block; margin:auto;text-align:center; color:red; cursor:pointer;"><i class="fa fa-times"></i> Remove</a>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<!-- display error message -->
<?php if (Yii::$app->session->hasFlash('error')) : ?>
  <div class="alert alert-danger alert-dismissible fade in text-left" style="width: 95%; max-width: 500px; margin:5px auto;">
    <a href="#" class="close pull-right" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error! </strong><?= Yii::$app->session->getFlash('error') ?>
  </div>
<?php endif; ?>

<div style="width:95%; padding:5px; margin:5px auto;">
    <h4 style="text-align: center;">Saloons</h4>
    <button onclick="addSaloon(this)" exch-id="<?= $session['exchange']['id']; ?>" exch-abbr="<?= $session['exchange']['abbr']; ?>" class="btn btn-success" style="display: block; margin:auto;"><i class="fa fa-plus fa-lg"></i> New Saloon </button>
</div>

<?php
foreach ($viewSaloons as $saloon) {
    $saloon_id = $saloon['id'];
    $saloon_width = $saloon['saloon_width'] * 100;
    $saloon_height = $saloon['saloon_height'] * 100;
?>
    <div class="panel-group" id="accordion-<?= $saloon_id; ?>" style="margin:10px auto; width:98%; height:auto; ">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title text-center">
                    <a data-toggle="collapse" data-parent="#accordion-<?= $saloon_id; ?>" href="#<?= 'saloon-collapse-' . $saloon_id; ?>">
                        <!-- title -->
                        <div style="display: flex; align-items:center; flex-wrap:wrap; justify-content: center;">
                            <div style="width:150px; height:60px;margin:5px;" class="bg-wt">
                                <h4 style="text-align:center; color:purple;">Building</h4>
                                <h5 style="text-align:center; color:slateblue;"><?= $saloon['building']; ?></h5>
                            </div>

                            <div style="width:100px; height:60px; margin:5px;" class="bg-wt">
                                <h4 style="text-align:center; color:purple;">Floor</h4>
                                <h5 style="text-align:center; color:slateblue;"><?= $saloon['floor']; ?></h5>
                            </div>

                            <div style="width:150px; height:60px;margin:5px;" class="bg-wt">
                                <h4 style="text-align:center; color:purple;">Saloon</h4>
                                <h5 style="text-align:center; color:slateblue;"><?= $saloon['saloon']; ?></h5>
                            </div>

                            <div style="width:150px; height:60px;margin:5px;" class="bg-wt">
                                <h4 style="text-align:center; color:purple;">Saloon Size</h4>
                                <h5 style="text-align:center; color:slateblue;"><?= $saloon["saloon_width"] . "m x " . $saloon["saloon_height"] . "m"; ?></h5>
                            </div>
                        </div>
                    </a>
                </h4>
                <!--  -->
                <button attr="<?= $saloon_id . ',' . $saloon['building'] . ',' . $saloon['floor'] . ',' . $saloon['saloon'] . ',' . $saloon['saloon_width'] . ',' . $saloon['saloon_height']; ?>" title="Remove Saloon" class="btn btn-danger" style="height:32px; float:right;" onclick="removeSaloon(this)"><i class="fa fa-times fa-lg"></i> Remove Saloon</button>
                <button attr="<?= $saloon_id . ',' . $saloon['building'] . ',' . $saloon['floor'] . ',' . $saloon['saloon'] . ',' . $saloon['saloon_width'] . ',' . $saloon['saloon_height']; ?>" title="Edit Saloon" class="btn btn-primary" style="height:32px; float:left;" onclick="editSaloon(this)"><i class="fa fa-edit fa-lg"></i> Edit Saloon</button>
                <br style="clear: both;" />
            </div>
            <div id="<?= 'saloon-collapse-' . $saloon_id; ?>" class="panel-collapse collapse in">
                <div class="panel-body" style="width: 98%; margin: 5px auto;padding:5px; height: 500px; overflow:auto;background-color:dimgray ">
                    <!-- saloon toolbar  -->
                    <div style="background-color:gainsboro;height:40px;width:100%;margin:2px; overflow-x:auto;display: flex; align-items:center; flex-wrap:wrap; justify-content: left;">
                        <button saloon-id="<?= $saloon_id; ?>" title="Rearrange Saloon" edit-toggle="0" style="border:none; width:40px;height:32px;background-color:transparent;border-radius:2px;" onclick="rearrangeSaloon(this)"><i id="<?= 'saloonEditToggle-'.$saloon_id; ?>" class="fa fa-toggle-off fa-lg" ></i> Edit</button>
                        <img class="template-objects" src="<?= Yii::$app->request->baseUrl . "/web/images/objects/rack.jpg"; ?>" style="display:none;cursor:pointer; width:32px;height:32px;margin:2px;" onclick="addRack(this)" title="Add New Rack" alt="Rack" saloon-id="<?= $saloon_id; ?>">
                        <img class="template-objects" src="<?= Yii::$app->request->baseUrl . "/web/images/objects/odf.jpg"; ?>" style="display:none;cursor:pointer; width:32px;height:32px;margin:2px;" onclick="addODF(this)" title="Add New ODF" alt="ODF" saloon-id="<?= $saloon_id; ?>">

                        <!-- template objects -->

                        <?php
                        foreach ($definedObjects as $obj) { ?>
                            <img class="template-objects" src="<?= $obj['object_icon']; ?>" style="display:none;cursor:pointer; width:32px;height:32px;margin:2px;" onclick="addObject(this)" title="<?= $obj['object_name']; ?>" alt="<?= $obj['object_name']; ?>" template-id="<?= $obj['id']; ?>" saloon-id="<?= $saloon_id; ?>">
                        <?php
                        }
                        ?>
                    </div>
                    <div class="saloon-div" style="position: relative;background-color:darkgray; margin:auto; margin-top:30px; width:<?= $saloon_width . 'px'; ?>; height:<?= $saloon_height . 'px'; ?>">
                        <!-- racks -->
                        <?php
                        foreach ($viewRacks as $rack) {
                            if ($saloon_id == $rack['saloon_id']) {
                                $rackId = $rack['id'];
                                $width = $rack['rack_width'];
                                $height = $rack['rack_height'];
                                $depth = $rack['rack_depth'];
                                $row = $rack['rack_row'];
                                $column = $rack['rack_column'];
                                $rotation = $rack['rack_rotation'];
                                $top = $rack['rack_top'];
                                $left = $rack['rack_left'];
                        ?>
                                <div class="rack-parent" id="rackId-<?= $rackId; ?>" style="width:<?= $width . "px"; ?> ;transform:rotate(<?= $rotation . "deg"; ?>);position:absolute;top:<?= $top . "px"; ?>; left:<?= $left . "px"; ?>;">
                                    <div class="fp-object-header" style="visibility:hidden;position:relative;width:100%; height:30px; line-height:30px; text-align:center;">
                                        <div class="rack-move" title="Drag" style="float:left;width:50%;cursor:move;background-color:#ccc;" onmousedown="dragRack(<?= $rackId; ?>)" onmouseup="dragRackDone(<?= $rackId; ?>)"><i class="fa fa-arrows-alt"></i></div>
                                        <div class="rack-edit" attr="<?= $rackId; ?>,<?= $width; ?>,<?= $height; ?>,<?= $depth; ?>,<?= $row; ?>,<?= $column; ?>,<?= $rotation; ?>" title="Edit" style="float:right;width:50%;cursor:pointer;background-color:#bbb;" onclick="editRack(this)"><i class="fa fa-edit"></i></div>
                                    </div>
                                    <a href="<?= Yii::$app->request->baseUrl . '/rack/index?id=' . $rackId; ?>">
                                    <div class="rack-rc" style="width:100%; height:20px; line-height:20px; text-align:center;background-color:indigo ;color:white;;"><?= $row . "-" . $column; ?></div>
                                    <div class="rack" style='width:100%; height:<?= $depth . "px"; ?>; background-color:slategray; '>
                                        <!-- devs -->

                                        <?php
                                        foreach ($viewRackDevs as $dev) {
                                            if ($rackId == $dev['rack_id']) {
                                                $rackdevId = $dev['id'];
                                                $shelf = $dev['shelf_no'];
                                                $device = $dev['device'];
                                                $deviceHeight = $dev['device_height'];
                                                $deviceName = $dev['device_name'];
                                        ?>
                                                    <p title="<?= $deviceName; ?>" style="text-align:center;font-size:10px;background-color:aliceblue;color:#000;"><?= $device; ?></p>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    </a>
                                </div>
                        <?php
                            }
                        }
                        ?>

                        <!-- odfs -->
                        <?php
                        foreach ($viewOdfs as $odf) {
                            if ($odf['saloon_id'] == $saloon_id) {
                                $odfId = $odf['id'];
                                $odfRow = $odf['odf_row'];
                                $odfColumn = $odf['odf_column'];
                                $odfNo = $odf['odf_no'];
                                $width = $odf['odf_width'];
                                $depth = $odf['odf_depth'];
                                $height = $odf['odf_height'];
                                $top = $odf['odf_top'];
                                $left = $odf['odf_left'];
                                $rotation = $odf['odf_rotation'];

                        ?>
                                <div class="odf-parent" id="odfId-<?= $odfId; ?>" style="width:<?= $width . "px"; ?>; transform:rotate(<?= $rotation . "deg"; ?>);position:absolute;top:<?= $top . 'px'; ?>; left:<?= $left . 'px'; ?>;">
                                    <div class="fp-object-header" style="visibility:hidden;position:relative;width:100%; height:30px; line-height:30px; text-align:center;">
                                        <div class="odf-move" title="Drag" style="float:left;width:50%;cursor:move;background-color:#ccc;" onmousedown="dragOdf(<?= $odfId; ?>)" onmouseup="dragOdfDone(<?= $odfId; ?>)"><i class="fa fa-arrows-alt"></i></div>
                                        <div class="odf-edit" attr="<?= $odfId; ?>,<?= $odfNo; ?>,<?= $width; ?>,<?= $height; ?>,<?= $depth; ?>,<?= $odfRow; ?>,<?= $odfColumn; ?>,<?= $rotation; ?>" title="Edit" style="float:right;width:50%;cursor:pointer;background-color:#bbb;" onclick="editOdf(this)"><i class="fa fa-edit"></i></div>
                                    </div>
                                    <a href="<?= Yii::$app->request->baseUrl . '/odf/index?id=' . $odfId; ?>">
                                        <div class="odf-rc" style=";width:100%; height:20px; line-height:20px; text-align:center;background-color:goldenrod ;color:white;"><?= $odfRow . "-" . $odfColumn; ?></div>
                                        <div class="odf" style='width:100%; height:<?= $depth . "px"; ?>; background-color:gainsboro; '>
                                            <!-- odf -->
                                            <p class="odfNo" style="padding-top:10px;margin:0;text-align:center; font-size:12px;color:#000;">ODF NO</p>
                                            <p class="odfNo" style="padding:0;margin:0;text-align:center; font-size:14px;color:#000;"><?= $odfNo; ?></p>

                                        </div>
                                    </a>
                                </div>

                        <?php

                            }
                        }
                        ?>
                        <!-- objects -->
                        <?php
                        foreach ($objects as $object) {
                            if ($object['saloon_id'] == $saloon_id) {
                                $objId = $object['id'];
                                $saloonId = $object['saloon_id'];
                                $objectTemplateId = $object['object_template_id'];
                                $font_size = $object['font_size'];
                                $text = $object['text'];
                                $objectWidth = $object['object_width'];
                                $objectDepth = $object['object_depth'];
                                $objectHeight = $object['object_height'];
                                $objectTop = $object['object_top'];
                                $objectLeft = $object['object_left'];
                                $objectRotation = $object['object_rotation'];
                                if ($objectTemplateId == null) {
                                    $objectTemplate = '<div id="objectId-OBJECT_ID" class="fp-text" style=" transform:rotate(OBJECT_ROTATION);position:absolute;min-width:50px; top:OBJECT_TOP;left:OBJECT_LEFT;"><div class="fp-object-header" style="visibility:hidden;position:relative;width:100%; height:30px; line-height:30px; text-align:center;"><div class="object-move" title="Drag" style="float:left;width:50%;cursor:move;background-color:#ccc;" onmousedown="dragObject(OBJECT_ID)" onmouseup="dragObjectDone(OBJECT_ID)"><i class="fa fa-arrows-alt"></i></div><div class="object-edit" attr="OBJECT_ID,FONT_SIZE,TEXT,OBJECT_ROTATION" title="Edit"  style="float:right;width:50%;cursor:pointer;background-color:#bbb;" onclick="editTextObject(this)"><i class="fa fa-edit"></i></div></div><div class="object" style="width:100%;font-size:FONT_SIZE;" >TEXT</div></div>';
                                    $objectTemplate = str_replace("OBJECT_ID", $objId, $objectTemplate);
                                    $objectTemplate = str_replace("OBJECT_TOP", $objectTop . "px", $objectTemplate);
                                    $objectTemplate = str_replace("OBJECT_LEFT", $objectLeft . "px", $objectTemplate);
                                    $objectTemplate = str_replace("OBJECT_ROTATION", $objectRotation . "deg", $objectTemplate);
                                    $objectTemplate = str_replace("FONT_SIZE", $font_size . "px", $objectTemplate);
                                    $objectTemplate = str_replace("TEXT", $text, $objectTemplate);

                                    echo $objectTemplate;
                                } else {
                                    $objectName = $objectsTemplate[$objectTemplateId]['name'];
                                    $objectTemplate = $objectsTemplate[$objectTemplateId]['template'];
                                    // OBJECT_ID; OBJECT_TOP; OBJECT_LEFT; OBJECT_WIDTH; OBJECT_HEIGHT;OBJECT_ROTATION
                                    $objectTemplate = str_replace("OBJECT_ID", $objId, $objectTemplate);
                                    $objectTemplate = str_replace("OBJECT_TOP", $objectTop . "px", $objectTemplate);
                                    $objectTemplate = str_replace("OBJECT_LEFT", $objectLeft . "px", $objectTemplate);
                                    $objectTemplate = str_replace("OBJECT_WIDTH", $objectWidth . "px", $objectTemplate);
                                    $objectTemplate = str_replace("OBJECT_0.5WIDTH", ($objectWidth / 2) . "px", $objectTemplate);
                                    $objectTemplate = str_replace("OBJECT_HEIGHT", $objectHeight . "px", $objectTemplate);
                                    $objectTemplate = str_replace("OBJECT_0.5HEIGHT", ($objectHeight / 2) . "px", $objectTemplate);
                                    $objectTemplate = str_replace("OBJECT_DEPTH", $objectDepth . "px", $objectTemplate);
                                    $objectTemplate = str_replace("OBJECT_0.5DEPTH", ($objectDepth / 2) . "px", $objectTemplate);
                                    $objectTemplate = str_replace("OBJECT_ROTATION", $objectRotation . "deg", $objectTemplate);

                                    echo $objectTemplate;
                                }
                            }
                        }
                        ?>

                        <!--
                            standard
                             <div id="objectId-OBJECT_ID" class="fp-single-door" style=" transform:rotate(OBJECT_ROTATION);position:absolute; top:OBJECT_TOP;left:OBJECT_LEFT; width:OBJECT_WIDTH;">
                            <div class="fp-object-header" style="visibility:hidden;position:relative;width:100%; height:30px; line-height:30px; text-align:center;">
                                <div class="object-move" title="Drag" style="float:left;width:50%;cursor:move;background-color:#ccc;" onmousedown="dragObject(OBJECT_ID)" onmouseup="dragObjectDone(OBJECT_ID)">
                                    <i class="fa fa-arrows-alt"></i>
                                </div>
                                <div class="object-edit" attr="OBJECT_ID,OBJECT_WIDTH,OBJECT_HEIGHT,OBJECT_DEPTH,OBJECT_ROTATION" title="Edit" style="float:right;width:50%;cursor:pointer;background-color:#bbb;" onclick="editObject(this)">
                                    <i class="fa fa-edit"></i>
                                </div>
                            </div>
                            <div class="object" style="width:100%; height:OBJECT_DEPTH; position:absolute;border-radius: 100% 0 0 0; border:3px solid black; border-bottom:none;">
                            </div>
                        </div>
                     -->

                    </div>
                </div>
            </div>
        </div>
    </div>

    <br />
<?php
}

require_once("modals/rackModal.php");
require_once("modals/odfModal.php");
require_once("modals/objectModal.php");
require_once("modals/textObjectModal.php");
require_once("modals/newTextModal.php");
require_once("modals/newObjectModal.php");
require_once("modals/newSaloonModal.php");
require_once("modals/saloonEditModal.php");
require_once("modals/saloonRemoveModal.php");
require_once("modals/newRackModal.php");
require_once("modals/newOdfModal.php");
require_once("modals/editExchangeModal.php");
require_once("modals/removeExchangeModal.php");


$bPath = Yii::$app->request->baseUrl;
$js = <<< JS
// drag
function dragRack(rackId)
{
    dragElement(document.getElementById("rackId-"+rackId));
}
function dragRackDone(rackId)
{
    document.onmouseup = null;
    document.onmousemove = null;
    document.getElementById("rackId-"+rackId).onmousedown = null;
    elmnt = document.getElementById("rackId-"+rackId);
    // save the element's new position:
    var top = elmnt.offsetTop;
    var left = elmnt.offsetLeft;

    $.ajax(
        {
        url: "$bPath/sitex/rearrange_rack",
        type:"POST",
        data:{'id':rackId, 'top':top, 'left':left},

        success: function(ok)
            {
            if(ok == false)
                alert("Cannot save the new position of the rack.");
            }
        }
    );
}
function addRack(obj)
{
    var saloonId = $(obj).attr("saloon-id"); 
    $("#newRackModalSaloonId").val(saloonId);
    $("#newRackModal").modal("show");
}

function dragOdf(odfId)
{
    dragElement(document.getElementById("odfId-"+odfId));
}
function dragOdfDone(odfId)
{
    document.onmouseup = null;
    document.onmousemove = null;
    document.getElementById("odfId-"+odfId).onmousedown = null;
    elmnt = document.getElementById("odfId-"+odfId);
    // save the element's new position:
    var top = elmnt.offsetTop;
    var left = elmnt.offsetLeft;

    $.ajax(
        {
        url: "$bPath/sitex/rearrange_odf",
        type:"POST",
        data:{'id':odfId, 'top':top, 'left':left},

        success: function(ok)
            {
            if(ok == false)
                alert("Cannot save the new position of the ODF.");
            }
        }
    );
}
function addODF(obj)
{
    var saloonId = $(obj).attr("saloon-id"); 
    $("#newOdfModalSaloonId").val(saloonId);
    $("#newOdfModal").modal("show");

}

function dragObject(objId)
{
    dragElement(document.getElementById("objectId-"+objId));
}
function dragObjectDone(objId)
{
    document.onmouseup = null;
    document.onmousemove = null;
    document.getElementById("objectId-"+objId).onmousedown = null;
    elmnt = document.getElementById("objectId-"+objId);
    // save the element's new position:
    var top = elmnt.offsetTop;
    var left = elmnt.offsetLeft;

    $.ajax(
        {
        url: "$bPath/sitex/rearrange_object",
        type:"POST",
        data:{'id':objId, 'top':top, 'left':left},

        success: function(ok)
            {
            if(ok == false)
                alert("Cannot save the new position of the object.");
            }
        }
    );
}

function dragElement(elmnt)
{
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  elmnt.onmousedown = dragMouseDown;
  

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    /* stop moving when mouse button is released:*/
    document.onmouseup = null;
    document.onmousemove = null;
  }
}
// edit
function editRack(obj)
{
    var attr = $(obj).attr("attr");
    attr = attr.split(",");
    var rackId = attr[0];
    var width = attr[1];
    width = width.replace("px", "");
    var height = attr[2];
    height = height.replace("px", "");
    var depth = attr[3];
    depth = depth.replace("px", "");
    var row = attr[4];
    var column = attr[5];
    var rotation = attr[6];
    rotation = rotation.replace("deg", "");

    $("#modalRackId").val(rackId);
    $("#modalRackWidth").val(width);
    $("#modalRackHeight").val(height);
    $("#modalRackDepth").val(depth);
    $("#modalRackRow").val(row);
    $("#modalRackColumn").val(column);
    $("#modalRackRotation").val(rotation);

    $("#rackModal").modal('show');
}

function editOdf(obj)
{
    var attr = $(obj).attr("attr");
    attr = attr.split(",");
    var odfId = attr[0];
    var odfNo = attr[1];
    var width = attr[2];
    width = width.replace("px", "");
    var height = attr[3];
    height = height.replace("px", "");
    var depth = attr[4];
    depth = depth.replace("px", "");
    var row = attr[5];
    var column = attr[6];
    var rotation = attr[7];
    rotation = rotation.replace("deg", "");

    $("#modalOdfId").val(odfId);
    $("#modalOdfNo").val(odfNo);
    $("#modalOdfWidth").val(width);
    $("#modalOdfHeight").val(height);
    $("#modalOdfDepth").val(depth);
    $("#modalOdfRow").val(row);
    $("#modalOdfColumn").val(column);
    $("#modalOdfRotation").val(rotation);

    $("#odfModal").modal('show');
}

function editObject(obj)
{
    var attr = $(obj).attr("attr");
    attr = attr.split(",");
    var objectId = attr[0];
    var width = attr[1];
    width = width.replace("px", "");
    var height = attr[2];
    height = height.replace("px", "");
    var depth = attr[3];
    depth = depth.replace("px", "");
    var rotation = attr[4];
    rotation = rotation.replace("deg", "");

    $("#modalObjectId").val(objectId);
    $("#modalObjectWidth").val(width);
    $("#modalObjectHeight").val(height);
    $("#modalObjectDepth").val(depth);
    $("#modalObjectRotation").val(rotation);

    $("#objectModal").modal('show');
}

function editTextObject(obj)
{
    var attr = $(obj).attr("attr");
    attr = attr.split(",");
    var objectId = attr[0];
    var fs = attr[1];
    fs = fs.replace("px", "");
    var text = attr[2];
    var rotation = attr[3];
    rotation = rotation.replace("deg", "");

    $("#modalTextObjectId").val(objectId);
    $("#modalTextObjectFs").val(fs);
    $("#modalTextObjectText").val(text);
    $("#modalTextObjectRotation").val(rotation);

    $("#textObjectModal").modal('show');
}

function addObject(obj)
{
    var saloonId = $(obj).attr("saloon-id"); 
    var templateId = $(obj).attr("template-id");
    var objectName = $(obj).attr("title");
    if(templateId == 1)
    {
        //text
        $("#newTextModalTitle").html("Add New "+objectName);
        $("#newTextSaloonId").val(saloonId);

        $("#newTextModal").modal('show');
    }
    else 
    {
        //object
        $("#newObjectModalTitle").html("Add New "+objectName);
        $("#newObjectSaloonId").val(saloonId);
        $("#newObjectTemplateId").val(templateId);

        $("#newObjectModal").modal('show');
    }

}

// saloon
function rearrangeSaloon(obj)
{
    var saloonId = $(obj).attr("saloon-id"); 
    var editToggle = $(obj).attr("edit-toggle");
    if(editToggle == 1)
    {
        // $(obj).css("color", "blue");
        $("#saloonEditToggle-"+saloonId).removeClass("fa-toggle-on");
        $("#saloonEditToggle-"+saloonId).addClass("fa-toggle-off");
        $("#saloonEditToggle-"+saloonId).removeClass("text-primary");
        $(obj).attr("edit-toggle", 0);
        $(".template-objects").css("display", "none");
        $("#saloon-collapse-"+saloonId+" .fp-object-header").css("visibility", "hidden");
    }
    else 
    {
        $("#saloonEditToggle-"+saloonId).removeClass("fa-toggle-off");
        $("#saloonEditToggle-"+saloonId).addClass("fa-toggle-on");
        $("#saloonEditToggle-"+saloonId).addClass("text-primary");
        $(obj).attr("edit-toggle", 1);
        $(".template-objects").css("display", "block");
        $("#saloon-collapse-"+saloonId+" .fp-object-header").css("visibility", "visible");
    }
    
}

function editSaloon(obj)
{
    var attr = $(obj).attr("attr");
    attr = attr.split(",");
    var saloonId = attr[0];
    var building = attr[1];
    var floor = attr[2];
    var saloon = attr[3];
    var width = attr[4];
    var height = attr[5];

    $("#saloonEditModalId").val(saloonId);
    $("#saloonEditModalBuilding").val(building);
    $("#saloonEditModalFloor").val(floor);
    $("#saloonEditModalSaloon").val(saloon);
    $("#saloonEditModalWidth").val(width);
    $("#saloonEditModalHeight").val(height);

    $("#saloonEditModal").modal("show");
    
}

function removeSaloon(obj)
{
    var attr = $(obj).attr("attr");
    attr = attr.split(",");
    var saloonId = attr[0];
    var building = attr[1];
    var floor = attr[2];
    var saloon = attr[3];
    var width = attr[4];
    var height = attr[5];

    $("#saloonRemoveModalId").val(saloonId);
    $("#saloonRemoveModalBuilding").val(building);
    $("#saloonRemoveModalFloor").val(floor);
    $("#saloonRemoveModalSaloon").val(saloon);
    $("#saloonRemoveModalWidth").val(width);
    $("#saloonRemoveModalHeight").val(height);

    $("#saloonRemoveModal").modal("show");
}

function addSaloon(obj)
{
    var exchId = $(obj).attr("exch-id"); 
    var exchAbbr = $(obj).attr("exch-abbr"); 

    $("#newSaloonModalTitle").html("Add "+exchAbbr+" New Saloon");
    $("#newSaloonExchId").val(exchId);
    $("#newSaloonModal").modal('show');
}
//
function editExchange(obj)
{
    var id = $(obj).attr("eid");
    var area = $(obj).attr("earea");
    var name = $(obj).attr("ename");
    var abbr = $(obj).attr("eabbr");
    var type= $(obj).attr("etype");
    var addr = $(obj).attr("eaddr");
    if( (area < 2 ) && (area >9) ) 
    {
        alert("Invalid area number is provided!");
        return;
    }
    $('#editExchId').val(id);
    $('#editExchArea').val(area);
    $('#editExchName').val(name);
    $('#editExchAbbr').val(abbr);
    $('#editExchType').val(type);
    $('#editExchAddress').val(addr);

    $("#editExchangeModal").modal('show');
}

function removeExchange(obj)
{
    var id = $(obj).attr("eid");
    var area = $(obj).attr("earea");
    var name = $(obj).attr("ename");
    var abbr = $(obj).attr("eabbr");
    var type= $(obj).attr("etype");
    var addr = $(obj).attr("eaddr");
    $('#removeExchId').val(id);
    $('#removeExchArea').val(area);
    $('#removeExchName').val(name);
    $('#removeExchAbbr').val(abbr);
    $('#removeExchType').val(type);
    $('#removeExchAddress').val(addr);

    $("#removeExchangeModal").modal('show');
}

JS;
$this->registerJs($js, Yii\web\View::POS_END);
?>