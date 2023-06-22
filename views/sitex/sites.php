<?php
$session = Yii::$app->session;
$session->open();
$area = -1;
if (isset($session['exchange']))
{
    $this->title = 'Planet|' . $session['exchange']['abbr'] . ' Sites';
    $area = $session['exchange']['area'];
}
else
    $this->title = 'Planet|Saloons';

use yii\helpers\Html;

if (isset($session['user'])) { ?>
    <div style="display: flex; align-items:center; flex-wrap:wrap; justify-content: center; position: sticky; top:0px; background-color:#eee;z-index:10;">

        <a href="<?= Yii::$app->request->baseUrl . '/main/provinces' ?>">
            <div class=" bg-menu  menu-box margin-5 padding-5" style="color:darkslateblue;margin-left:5px;text-align:center; cursor:pointer;">
                <i class="fa fa-home  menu-icon"></i>
                <p class="menu-title" style="">Province</p>
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

        <a href="<?= Yii::$app->request->baseUrl . '/sitex/exchange'; ?>">
            <div class=" bg-menu  menu-box margin-5 padding-5" style="color:saddlebrown;margin-left:5px;text-align:center; cursor:pointer;">
                <i class="fa fa-building  menu-icon" ></i>
                <p class="menu-title"><?= $session['exchange']['abbr']; ?></p>
            </div>
        </a>

        <div onclick="searchSiteInExch(<?= $session['exchange']['id']; ?>)" class=" bg-menu menu-box padding-5 margin-5"  style="cursor:pointer;margin-left:10px;text-align:center;color:steelblue;">
            <i class="fa fa-search menu-icon"></i>
            <p class="menu-title menu-title">sites</p>
        </div>

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

        <div class=" bg-wt  margin-5  padding-5" style="height: 100px;width:200px;color:mediumvioletred;">
            <i class="fa fa-sitemap fa-2x " style=" display:block; margin:auto; "></i>
            <hr />
            <p class="text-center"><?= $session['exchange']['abbr'] . ' Sites'; ?></p>
        </div>
    </div>
<?php }
// display error message
 if (Yii::$app->session->hasFlash('error')) { ?>
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
<?php }
?>
<div style="width:95%; padding:5px; margin:5px auto;">
    <h4 style="text-align: center;">Cascades</h4>
    <button onclick="addCascade(this)" exchange-id="<?= $session['exchange']['id']; ?>" exchange-abbr="<?= $session['exchange']['abbr']; ?>" class="btn btn-success" style="display: block; margin:auto;"><i class="fa fa-plus fa-lg"></i> New Cascade </button>
</div>

<?php

//cascade1=>[ node1=>[id=>'', name='',abbr=>'', uplink_id=>uid, 'uplink_abbr'=>'', address=''], node2=>[]... ],
foreach($sites as $cascade=>$info)
{?>
    <div class="panel-group" id="site-cascade-<?= $cascade; ?>" style="margin:10px auto; width:98%; height:auto; ">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title text-center">
                    <a data-toggle="collapse" data-parent="#site-cascade-<?= $cascade; ?>" href="#<?= 'site-collapse-' . $cascade; ?>">
                        <!-- title -->
                        <div style="display: flex; align-items:center; flex-wrap:wrap; justify-content: center;">
                            <div style="width:150px; height:60px;margin:5px;" class="bg-wt">
                                <h4 style="text-align:center; color:purple;">Cascade</h4>
                                <h4 style="text-align:center; color:slateblue;"><?= $cascade; ?></h4>
                            </div>
                        </div>
                    </a>
                </h4>
            </div>
            <div id="<?= 'site-collapse-' . $cascade; ?>" class="panel-collapse collapse">
                <div class="panel-body" style="width: 98%;height:auto; margin: 5px auto;padding:5px;background-color:dimgray ">
                    <!-- cascade toolbar  -->
                    <div style="background-color:gainsboro;height:40px;width:100%;margin:2px; overflow-x:auto;display: flex; align-items:center; flex-wrap:wrap; justify-content: left;">
                        <button cascade="<?= $cascade; ?>" title="Rearrange Topology" edit-toggle="0" style="border:none; width:40px;height:32px;background-color:transparent;border-radius:2px;" onclick="rearrangeSites(this)"><i id="<?= 'cascadeEditToggle'.$cascade; ?>" class="fa fa-toggle-off fa-lg"></i> Edit</button>
                        <button class="toolbar-buttons" style="display:none;height:32px;margin:2px; padding:2px;background-color:transparent;border:none;" onclick="addNewSite(this)" title="Add New Site" cascade="<?= $cascade; ?>" exchange-id="<?= $session['exchange']['id']; ?>" exchange-abbr="<?= $session['exchange']['abbr']; ?>" exchange="<?= $session['exchange']['name']; ?>" uplink='<?= json_encode($info); ?>'><i class="fa fa-plus fa-lg text-primary"></i></button>




                    </div>
                    <div class="cascade-div" id="<?= 'site-cascade'.$cascade; ?>" style="position: relative;background-color:darkgray; border-left: 20px solid mediumvioletred; margin:auto; margin-top:30px; width:100%;min-height:600px;height:auto;overflow:auto;">

                        <!--sites topology-->
                        <!-- draw links -->
                        <?php
                        foreach($links[$cascade] as $link){ ?>
                            <svg width="<?= $link['viewport'][0]+10; ?>" height="<?= $link['viewport'][1]+10; ?>" sid="<?= $link['sId']; ?>" upid="<?= $link['upId']; ?>" style="position: absolute;">
                                <line class='line' x1="<?= $link['points'][0]; ?>" y1="<?= $link['points'][1]; ?>" x2="<?= $link['points'][2]; ?>" y2="<?= $link['points'][3]; ?>" style="stroke:#550000;stroke-width:3" />
                                <circle class='node-site' cx="<?= $link['points'][0]; ?>" cy="<?= $link['points'][1]; ?>" r="5" stroke="mediumvioletred" stroke-width="3" fill="mediumvioletred" />
                                <circle class='node-uplink' cx="<?= $link['points'][2]; ?>" cy="<?= $link['points'][3]; ?>" r="5" stroke="mediumvioletred" stroke-width="3" fill="mediumvioletred" />
                            </svg>
                        <?php } ?>

                        <!--     site width and height: 120x100       -->
                        <?php
                        foreach($info as $node=>$site)
                            {
                                ?>
                                <div class="site-parent" id="<?= 'site-'.$site['id']; ?>" title="<?= $site['address']; ?>" style="width:120px;position:absolute;top:<?= $site['site_top'] . 'px'; ?>; left:<?= $site['site_left'] . 'px'; ?>;">
                                    <div class="sitebox-header" style="visibility:hidden;position:relative;width:100%; height:30px; line-height:30px; text-align:center;">
                                        <div class="site-move-edit" title="Drag" style="float:left;width:50%;cursor:move;background-color:#ccc;" onmousedown="dragSite(<?= $cascade; ?>,<?= $site['id']; ?>)" onmouseup="dragSiteDone(<?= $site['id']; ?>)"><i class="fa fa-arrows-alt"></i></div>
                                        <div class="site-move-edit" site-id="<?= $site['id']; ?>" site-name="<?= $site['name']; ?>" site-abbr="<?= $site['abbr']; ?>" site-uplink="<?= $site['uplink_id']; ?>" site-cascade="<?= $cascade; ?>" site-node="<?= $node; ?>" site-address="<?= $site['address']; ?>"  uplinks='<?= json_encode($info); ?>' title="Edit" style="float:right;width:50%;cursor:pointer;background-color:#bbb;" onclick="editSite(this)"><i class="fa fa-edit"></i></div>
                                    </div>
                                    <a href="<?= Yii::$app->request->baseUrl . '/sitex/site?id=' . $site['id']; ?>">
                                        <div class="cas-class" style=";width:100%; height:20px; line-height:20px; text-align:center;background-color:goldenrod ;color:white;"><?= 'Cascade:'.$cascade; ?></div>
                                        <div class="node-class" style=";width:100%; height:20px; line-height:20px; text-align:center;background-color:goldenrod ;color:white;"><?= 'Node:'.$node; ?></div>

                                        <div class="site-info" style='width:100%; height:100px; background-color:mistyrose '>
                                            <!-- name -->
                                            <p class="siteName" style="padding-top:10px;margin:0;text-align:center; font-size:12px;color:#000;"><?= $site['name']; ?></p>
                                            <p class="siteAbbr" style="padding:0;margin:0;text-align:center; font-size:14px;color:#000;"><?= $site['abbr']; ?></p>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br />

<?php
}

require_once("modals/search/seachSiteInAreaExchModal.php");
require_once("modals/newCascadeModal.php");
require_once("modals/newSiteModal.php");
require_once("modals/editSiteModal.php");

$bPath = Yii::$app->request->baseUrl;
$abbr = $session['exchange']['abbr'];
$exchId = $session['exchange']['id'];
$exchange = $session['exchange']['name'];
$js = <<< JS

function searchSiteInExch()
{ 
    $.ajax(
        {
        url: "$bPath/sitex/search_site_in_exchange",
        success: function(searchHtml)
            {
                if(searchHtml == "")
                {
                    return ;
                }
                else 
                {
                    $("#ssix-body").html(searchHtml);
                    $("#ssix-title").html("Search $abbr Sites");
                    $("#searchSiteInAreaModal").modal("show");
                }
            }
        }
         );
}

// drag
function dragSite(cascade, siteId)
{
    dragElement(document.getElementById("site-"+siteId),cascade, siteId);
}
function dragSiteDone(siteId)
{
    document.onmouseup = null;
    document.onmousemove = null;
    document.getElementById("site-"+siteId).onmousedown = null;
    elmnt = document.getElementById("site-"+siteId);
    // save the element's new position:
    var top = elmnt.offsetTop;
    var left = elmnt.offsetLeft;

    $.ajax(
        {
        url: "$bPath/sitex/rearrange_site",
        type:"POST",
        data:{'id':siteId, 'top':top, 'left':left},

        success: function(ok)
            {
            if(ok == false)
                alert("Cannot save the new position of the site.");
            }
        }
    );
}

function dragElement(elmnt,cascade, siteId)
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
    var top = parseInt(elmnt.offsetTop - pos2);
    var left = parseInt(elmnt.offsetLeft - pos1);
    elmnt.style.top = top + "px";
    elmnt.style.left = left + "px";
    
    // find links and update
    // site side
    var objects = $("#site-cascade"+cascade+" svg[sid="+siteId+"]");
    var i = 0;
    for(i=0; i<objects.length; i++)
        {
            var item = objects[i];
            var uplink_id = $(item).attr("upid");
            var line = $(item).find(".line");
            var x1 = parseInt($(line).attr("x1"));
            var y1 = parseInt($(line).attr("y1"));
            var x2 = parseInt($(line).attr("x2"));
            var y2 = parseInt($(line).attr("y2"));
            if(uplink_id == $exchId)
                {
                    x2 = 0;
                    y2 = y1;
                    $(line).attr("x2",0);
                    $(line).attr("y2",y2);
                    $(item).find(".node-uplink").attr("cx", 0);
                    $(item).find(".node-uplink").attr("cy", y2); 
                }
            var w = x1;
            var h = y1;
            if(x1 < x2) w = x2;
            if(y1 < y2) h = y2;   
            w = w + 150;
            h = h + 200;
            $(item).attr("width",w);
            $(item).attr("height", h);

            $(line).attr("x1",left);
            $(line).attr("y1",top+120);
            $(item).find(".node-site").attr("cx", left);
            $(item).find(".node-site").attr("cy", top+120);   
        }
    //uplink side
    var objects = $("#site-cascade"+cascade+" svg[upid="+siteId+"]");
    var i = 0;
    for(i=0; i<objects.length; i++)
        {
            var item = objects[i];
            var line = $(item).find(".line");
            var x1 = parseInt($(line).attr("x1"));
            var y1 = parseInt($(line).attr("y1"));
            var x2 = parseInt($(line).attr("x2"));
            var y2 = parseInt($(line).attr("y2"));
            var w = x1;
            var h = y1;
            if(x1 < x2) w = x2;
            if(y1 < y2) h = y2;   
            w = w + 150;
            h = h + 200;
            $(item).attr("width",w);
            $(item).attr("height", h);

            $(line).attr("x2",left+120);
            $(line).attr("y2",top+120);
            $(item).find(".node-uplink").attr("cx", left+120);
            $(item).find(".node-uplink").attr("cy", top+120);   
        }
    //
  }

  function closeDragElement() {
    /* stop moving when mouse button is released:*/
    document.onmouseup = null;
    document.onmousemove = null;
  }
}

function rearrangeSites(obj)
{
    var cascade = $(obj).attr("cascade"); 
    var editToggle = $(obj).attr("edit-toggle");
    if(editToggle == 1)
    {
        $("#cascadeEditToggle"+cascade).removeClass("fa-toggle-on");
        $("#cascadeEditToggle"+cascade).addClass("fa-toggle-off");
        $("#cascadeEditToggle"+cascade).css("color","black");
        $(obj).attr("edit-toggle", 0);
        $("#site-collapse-"+cascade+" .toolbar-buttons").css("display", "none");
        $("#site-cascade"+cascade+" .site-move-edit").css("visibility", "hidden");
    }
    else 
    {
        $("#cascadeEditToggle"+cascade).removeClass("fa-toggle-off");
        $("#cascadeEditToggle"+cascade).addClass("fa-toggle-on");
        $("#cascadeEditToggle"+cascade).css("color","mediumvioletred");
        $(obj).attr("edit-toggle", 1);
        $("#site-collapse-"+cascade+" .toolbar-buttons").css("display", "block");
        $("#site-cascade"+cascade+" .site-move-edit").css("visibility", "visible");
        
    }
}

function addNewSite(obj)
{
    var exchId = $(obj).attr("exchange-id");
    var abbr = $(obj).attr("exchange-abbr");
    var exch = $(obj).attr("exchange");
    var cascade = $(obj).attr("cascade");
    var uplink = $(obj).attr('uplink');
    uplink = JSON.parse(uplink);
    $("#newSiteUplinkId").empty();
    var o = new Option(" مرکز "+exch, exchId);
    $("#newSiteUplinkId").append(o);
    // { node1:{id:'', name:'',abbr:'', uplink_id:uid, 'uplink_abbr':'', address:''], node2:{}... }
    for(var node in uplink)
        {
            var o = new Option(uplink[node]['name'], uplink[node]['id']);
            $("#newSiteUplinkId").append(o);
        }
    $("#newSiteMotherId").val(exchId);
    $("#newSiteMother").val(abbr);
    $("#newSiteCascade").val(cascade);
    
    $("#newSiteModal").modal('show');
}

function editSite(obj)
{
    var siteId = $(obj).attr("site-id");
    var mother = "$abbr";
    var abbr = $(obj).attr("site-abbr");
    var name = $(obj).attr("site-name");
    var uplinkId = $(obj).attr("site-uplink");
    var address = $(obj).attr("site-address");
    var siteCascade = $(obj).attr("site-cascade");
    var siteNode = $(obj).attr("site-node");
    var uplinks = $(obj).attr("uplinks");
    uplinks = JSON.parse(uplinks);
    $("#editSiteUplinkId").empty();
    var o = new Option(" مرکز "+"$exchange", $exchId);
    $("#editSiteUplinkId").append(o);
    // { node1:{id:'', name:'',abbr:'', uplink_id:uid, 'uplink_abbr':'', address:''], node2:{}... }
    for(var node in uplinks)
        {
            if(uplinks[node]['id'] == siteId) continue;
            var o = new Option(uplinks[node]['name'], uplinks[node]['id']);
            $("#editSiteUplinkId").append(o);
        }
    $("#editSiteId").val(siteId);
    $("#editSiteMother").val(mother);
    $("#editSiteAbbrId").val(abbr);
    $("#editSiteNameId").val(name);
    $("#editSiteUplinkId").val(uplinkId);
    $("#editSiteCurrentUplink").val(uplinkId);
    $("#editSiteCascade").val(siteCascade);
    $("#editSiteNode").val(siteNode);
    $("#editSiteAddressId").val(address);
    
    $("#editSiteModal").modal('show');

}

function addCascade(obj)
{
    var motherId = $(obj).attr("exchange-id");
    var mother = $(obj).attr("exchange-abbr");
    
    $("#newCascadeMotherId").val(motherId);
    $("#newCascadeMother").val(mother);
    $("#newCascadeUplink").val(mother);
   
    $("#newCascadeModal").modal('show');
}
JS;
$this->registerJs($js, Yii\web\View::POS_END);
?>