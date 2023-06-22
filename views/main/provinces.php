<?php
$this->title = 'Planet|Home|Province';
use yii\helpers\Html;
$session = Yii::$app->session;
$session->open();
?>
<?php if (isset($session['user'])) { ?>

    <div style="display: flex; align-items:center; flex-wrap:wrap; justify-content: center; position: sticky; top:0px; background-color:#eee;z-index:10;">

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

        <div onclick="searchInProvince()" class=" bg-menu menu-box padding-5 margin-5"  style="cursor:pointer;margin-left:10px;text-align:center;color:steelblue;">
            <i class="fa fa-search menu-icon"></i>
            <p class="menu-title menu-title">Exch/site</p>
        </div>

        <a href="<?= Yii::$app->request->baseUrl . '/log/index'; ?>" style="margin-left:5px;text-align:center; color:blue;">
            <div class=" bg-menu  menu-box margin-5 padding-5" style="color:sienna;">
                <i class="fa fa-history menu-icon"></i>
                <p  class="menu-title">Logs</p>
            </div>
        </a>

        <a href="<?= Yii::$app->request->baseUrl . '/stat/index'; ?>" style="margin-left:5px;text-align:center; color:blue;">
            <div class=" bg-menu  menu-box margin-5 padding-5" style="color:indigo;">
                <i class="fa fa-chart-pie menu-icon"></i>
                <p class="menu-title">statistics</p>
            </div>
        </a>

        <a href="<?= Yii::$app->request->baseUrl . '/tools/index'; ?>" style="margin-left:5px;text-align:center; color:blue;">
            <div class=" bg-menu  menu-box margin-5 padding-5" >
                <i class="fa fa-medkit text-warning menu-icon"></i>
                <p class="text-warning menu-title">Tools</p>
            </div>
        </a>

        <div onclick="openProfile();" class=" bg-menu  menu-box margin-5 padding-5" style="color:darkolivegreen;margin-left:5px;text-align:center; cursor:pointer;">
            <i class="fa fa-user menu-icon"></i>
            <p class="menu-title">Profile</p>
        </div>

        <a href="<?= Yii::$app->request->baseUrl . '/main/logout'; ?>" style="margin-left:5px;text-align:center;">
            <div class="bg-menu menu-box  margin-5 padding-5" style="color:red;">
                <i class="fa fa-sign-out-alt menu-icon"></i>
                <p class="menu-title">Log out</p>
            </div>
        </a>
    </div>

    <br />
    <div style="height: 100px;width:300px;margin:auto;">
        <i class="fa fa-home fa-2x " style=" display:block; margin:auto; color:dodgerblue;"></i>
        <h4 class="text-center text-color" style="margin:10px;"><?php if ($session['user']['province_id'] == 0) echo "Iran Privileges";
            else echo $session['user']['province'] . " Province"; ?></h4>
        <?php if ($session['user']['province_id'] > 0) { ?>
            <h5 style="margin:10px;" class="text-center text-color"><?= $session['user']['office'] . " Office"; ?></h5>
        <?php } ?>
    </div>


<?php } ?>

  <!-- display error message -->
  <?php if (Yii::$app->session->hasFlash('error')): ?>
    <div  class="alert alert-danger alert-dismissible fade in" style="max-width: 80%; margin: auto;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <?= Yii::$app->session->getFlash('error') ?>
    </div>
    <br/>
  <?php endif; ?>
    <!-- display success message -->
<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissible fade in " style="max-width: 80%; margin: auto;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
    <br/>
<?php endif; ?>


    <div class="row" style="width:100%; padding:5px; ">
        <!--display:flex; align-items:center; justify-content:center; -->
        <div class="col col-md-6">
            <!-- province map -->
            <?php require("provinces_map/province-" . $session['user']['province_id'] . ".php"); ?>
        </div>

        <div class="col col-md-6">
            <!-- iran map -->
            <?php require("provinces_map/iran_map.php"); ?>
        </div>
    </div>

<?php
require_once("modals/search/seachInProvinceModal.php");
require_once("modals/menuModals/profileModal.php");


$bPath = Yii::$app->request->baseUrl;
$js = <<< JS

function searchInProvince()
{ 
    $.ajax(
        {
        url: "$bPath/main/search_in_province",
        //type:"POST",
        //data:{'provinceId':provinceId},
        success: function(searchHtml)
            {
                if(searchHtml == "")
                {
                    return ;
                }
                else 
                {
                    $("#sip-body").html(searchHtml);
                    $("#searchInProvinceModal").modal("show");
                }
            }
        }
         );
}

JS;
$this->registerJs($js, Yii\web\View::POS_END);
?>