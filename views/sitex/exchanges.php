<?php
$this->title = 'Planet|Exchanges';

use yii\helpers\Html;
use app\components\ExchangeWidget;

$session = Yii::$app->session;
$session->open();

if (isset($session['user'])) { ?>
    <div style="display: flex; align-items:center; flex-wrap:wrap; justify-content: center; position: sticky; top:0px; background-color:#eee;z-index:10;">

        <a href="<?= Yii::$app->request->baseUrl . '/main/provinces' ?>">
            <div class=" bg-menu  menu-box margin-5 padding-5" style="color:darkslateblue;margin-left:5px;text-align:center; cursor:pointer;">
                <i class="fa fa-home  menu-icon"></i>
                <p class="menu-title">Province</p>
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

        <div onclick="searchSiteInArea(<?= $area ?>)" class=" bg-menu menu-box padding-5 margin-5"  style="cursor:pointer;margin-left:10px;text-align:center;color:steelblue;">
            <i class="fa fa-search menu-icon"></i>
            <p class="menu-title menu-title">Area sites</p>
        </div>

        <div onclick="addNewExchange(<?= $area ?>)" class=" bg-menu menu-box padding-5 margin-5"  style="cursor:pointer;margin-left:10px;text-align:center;color:lightseagreen;">
            <i class="fa fa-plus menu-icon"></i>
            <p class="menu-title menu-title">New Exch</p>
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

            <div class=" bg-wt  margin-5  padding-5" style="height: 100px;width:200px;">
                <i class="fa fa-cloud fa-2x " style=" display:block; margin:auto; color:royalblue;"></i>
                <hr />
                <?php if ($area > -1) { ?>
                    <h5 style="margin:10px;" class="text-center text-color"><?= "Area: ".$area; ?></h5>
                <?php }else{ ?>
                    <h5 style="margin:10px;" class="text-center text-color">Iran</h5>
                <?php } ?>
            </div>
    </div>
<?php } ?>

<div style="width:95%; padding:5px; margin:5px auto;">
    <h4 style="text-align: center;">Exchanges List</h4>
    <form onsubmit="goIntoAbbr(); return false;">
    <div class="input-group" style="max-width: 400px; min-width: 100;height: 30px;margin: auto;">
        <input type="text" id="abbr_search_id"  class="form-control" style="height:30px;" placeholder="search Abbr">
        <span class="input-group-addon" onclick="goIntoAbbr();" type="submit" style="cursor:pointer;height: 30px; width:120px;">Search</span>
    </div>
    </form>
</div>

<div style="display: flex; align-items:center; flex-wrap:wrap; justify-content: center;">
    <?php
    foreach ($exchangesModel as $model) {
        echo ExchangeWidget::widget(['model' => $model]);
    }
    ?>
</div>

<?php
require_once("modals/search/seachSiteInAreaExchModal.php");
require_once("modals/newExchangeModal.php");

$bPath = Yii::$app->request->baseUrl;
$js = <<< JS

function goIntoAbbr()
{
    var abbr = $("#abbr_search_id").val();
    abbr = abbr.toUpperCase();
    var comp = document.getElementById("comp-"+abbr);
    comp.scrollIntoView();
    window.scrollBy(0,-100);
    //$('html,body').animate({scrollTop: $(window).scrollTop() - 50 });
    $(".comp-div").css("background-color", "gainsboro");
    $("#comp-div-"+abbr).css("background-color", "yellowgreen");
}

function addNewExchange(area)
{
    $("#newExchAreaId").val(area);
    $("#newExchNameId").val("");
    $("#newExchAbbrId").val("");
    $("#newExchAddressId").val("");
    $("#newExchangeModal").modal("show");
}

function searchSiteInArea(area)
{ 
    $.ajax(
        {
        url: "$bPath/sitex/search_site_in_area",
        type:"POST",
        data:{'area':area},
        success: function(searchHtml)
            {
                if(searchHtml == "")
                {
                    return ;
                }
                else 
                {
                    $("#ssix-body").html(searchHtml);
                    $("#ssix-title").html("Search Area "+ area+" Sites");
                    $("#searchSiteInAreaModal").modal("show");
                }
            }
        }
         );
}

JS;
$this->registerJs($js, Yii\web\View::POS_END);
?>