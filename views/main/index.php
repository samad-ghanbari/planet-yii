<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'DaNet-Main Page';

Yii::$app->formatter->nullDisplay = "";
?>
<style>
.box_shadow
{
  box-shadow:0px 4px 8px 4px rgba(0,0,0,0.5);
  -moz-box-shadow:0px 4px 8px 4px rgba(0,0,0,0.5);
  -webkit-box-shadow:0px 4px 8px 4px rgba(0,0,0,0.5);

  border-radius: 5px;
}

#viewIntTable tbody tr:hover
{
  background-color: #5bc0de;
}

.selectedRow
{
   box-shadow:       0px 2px 4px 2px rgba(0, 0, 0,0.5);
  -moz-box-shadow:   0px 2px 4px 2px rgba(0, 0, 0,0.5);
  -webkit-box-shadow:0px 2px 4px 2px rgba(0, 0, 0,0.5);
  color:#0275d8;
  font-weight: bold;
  border:2px solid #5bc0de;
}

</style>


<div style="overflow: auto; height: 100%; font-size: 12px;">

  <?= GridView::widget([
    //'options'=>["class"=>""],
    'tableOptions'=>['id'=>"viewIntTable", 'class'=>'table table-striped table-bordered table-hover text-center'],
    //'headerRowOptions'=>['class'=>'bg-warning text-center'],
    'rowOptions' =>function ($model, $key, $index, $grid) {return ['id'=>'row'.$model['int_id'], 'class'=>'table_row', 'onclick'=>'activateRow(this.getAttribute("id"));', 'ondblclick'=>'modalShow(this.getAttribute("id"));', "oncontextmenu" =>"event.preventDefault();modalShow(this.getAttribute('id'));"];},
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
      //0
      [
        'attribute' =>'int_id',
        'visible'=>0,
        'contentOptions' => ['class' => 'INT_ID']
      ],
      //1
      [
        'attribute' =>'slot_id',
        'visible'=>0,
        'contentOptions' => ['class' => 'SLOT_ID']
      ],
      //2
      [
        'attribute' =>'devex_id',
        'visible'=>0,
        'contentOptions' => ['class' => 'DEVEX_ID']
      ],
      //3
      [
        'attribute' =>'exchange_id',
        'visible'=>0,
        'contentOptions' => ['class' => 'EXCHANGE_ID']
      ],
      //4
      [
        'attribute' =>'area_no',
        'visible'=>0,
        'contentOptions' => ['class' => 'AREA_NO']
      ],
      //5
      [
        'attribute' =>'area',
        'headerOptions' => ['class' => 'bg-warning text-center'],
        'contentOptions' => ['class' => 'text-center AREA', 'style'=>"vertical-align: middle;"],
      ],
      //6
      [
        'attribute' =>'abbr',
        'headerOptions' => ['class' => 'bg-warning text-center'],
        'contentOptions' => ['class' => 'text-center ABBR', 'style'=>"vertical-align: middle;"],
      ],

      //7
      [
        'attribute' =>'exchange',
        'visible'=>0,
        'contentOptions' => ['class' => 'EXCHANGE']
      ],
      //8
      [
        'attribute' =>'saloon_no',
        'visible'=>0,
        'contentOptions' => ['class' => 'SALOON_NO']
      ],
      //9

      [
        'attribute' =>'saloon_name',
        'headerOptions' => ['class' => 'bg-warning text-center'],
        'contentOptions' => ['class' => 'text-center SALOON_NAME', 'style'=>"vertical-align: middle;"],
      ],

      //10
      [
        'attribute' =>'device_id',
        'visible'=>0,
        'contentOptions' => ['class' => 'DEVICE_ID']
      ],

      //11
      [
        'attribute' =>'device',
        'headerOptions' => ['class' => 'bg-warning text-center'],
        'contentOptions' => ['class' => 'text-center DEVICE', 'style'=>"vertical-align: middle;"],
      ],
      //12
      [
        'attribute' =>'interface_type',
        'headerOptions' => ['class' => 'bg-warning text-center'],
        'contentOptions' => ['class' => 'text-center INTERFACE_TYPE', 'style'=>"vertical-align: middle;"],
      ],
      //13
      [
        'attribute' =>'shelf',
        'visible'=>0,
        'contentOptions' => ['class' => 'SHELF']
      ],
      //14
      [
        'attribute' =>'slot',
        'visible'=>0,
        'contentOptions' => ['class' => 'SLOT']
      ],
      //15
      [
        'attribute' =>'sub_slot',
        'visible'=>0,
        'contentOptions' => ['class' => 'SUB_SLOT']
      ],
      //16
      [
        'attribute' =>'port',
        'visible'=>0,
        'contentOptions' => ['class' => 'PORT']
      ],
      //17
      [
        'attribute' =>'interface',
        'headerOptions' => ['class' => 'bg-warning text-center'],
        'contentOptions' => ['class' => 'text-center INTERFACE', 'style'=>"vertical-align: middle;"],
      ],

      //18
      [
        'attribute' =>'pin_id',
        'visible'=>0,
        'contentOptions' => ['class' => 'PIN_ID']
      ],
      //19
      [
        'attribute' =>'label',
        'headerOptions' => ['class' => 'bg-warning text-center'],
        'contentOptions' => ['class' => 'text-center LABEL', 'style'=>"vertical-align: middle;"],
      ],
      //20
      [
        'attribute' =>'module',
        'headerOptions' => ['class' => 'bg-warning text-center'],
        'contentOptions' => ['class' => 'text-center MODULE', 'style'=>"vertical-align: middle;"],
      ],
      //21
      [
        'attribute' =>'peer_abbr',
        'headerOptions' => ['class' => 'bg-warning text-center'],
        'contentOptions' => ['class' => 'text-center PEER_ABBR', 'style'=>"vertical-align: middle;"],
      ],
      //22
      [
        'attribute' =>'peer_device',
        'headerOptions' => ['class' => 'bg-warning text-center'],
        'contentOptions' => ['class' => 'text-center PEER_DEVICE', 'style'=>"vertical-align: middle;"],
      ],
      //23
      [
        'attribute' =>'peer_interface',
        'headerOptions' => ['class' => 'bg-warning text-center'],
        'contentOptions' => ['class' => 'text-center PEER_INTERFACE', 'style'=>"vertical-align: middle;"],
      ],
      //24
      [
        'attribute' =>'peer_label',
        'headerOptions' => ['class' => 'bg-warning text-center'],
        'contentOptions' => ['class' => 'text-center PEER_LABEL', 'style'=>"vertical-align: middle;"],
      ],
      //25
      [
        'attribute' =>'ether_trunk',
        'headerOptions' => ['class' => 'bg-warning text-center'],
        'contentOptions' => ['class' => 'text-center ETHER_TRUNK', 'style'=>"vertical-align: middle;"],
      ],
      //26
    ],

  ]);

  ?>

</div>


<!-- context -->
<div class="box_shadow modal fade" id="contextModal" role="dialog">
  <div class="modal-dialog modal-sm ">
    <div class="modal-content">
      <div class="modal-body list-group" style="font-size: 12px;">
        <a onclick="assignInterface($('#CONTEXT_ROW_IND').val());" style="cursor: pointer;" id="contextAssign" class="list-group-item"><?= Html::img('@web/web/images/connection.png', ['style'=>"width:16px;"]); ?> Assign Interface</a>
        <a onclick="modifyInterface($('#CONTEXT_ROW_IND').val());" style="cursor: pointer;" id="contextModify" class="list-group-item"><?= Html::img('@web/web/images/edit.png', ['style'=>"width:16px;"]); ?> Modify Interface</a>
        <a onclick="emptyInterface($('#CONTEXT_ROW_IND').val());" style="cursor: pointer;" id="contextEmpty" class="list-group-item"><?= Html::img('@web/web/images/disconnection.png', ['style'=>"width:16px;"]); ?> Empty Interface</a>
        <br />
        <a onclick="changeModule($('#CONTEXT_ROW_IND').val());" style="cursor: pointer;" class="list-group-item"><?= Html::img('@web/web/images/sfp.png', ['style'=>"width:16px;"]); ?> Change Module</a>
        <a onclick="changeIntType($('#CONTEXT_ROW_IND').val());" style="cursor: pointer;" class="list-group-item"><?= Html::img('@web/web/images/interface.png', ['style'=>"width:16px;"]); ?> Change Interface Type</a>
        <br />
        <a onclick="viewODF($('#CONTEXT_ROW_IND').val());" style="cursor: pointer;" class="list-group-item"><?= Html::img('@web/web/images/fiber.png', ['style'=>"width:16px;"]); ?> View ODF Position</a>
        <a onclick="changeODF($('#CONTEXT_ROW_IND').val());" style="cursor: pointer;" class="list-group-item"><?= Html::img('@web/web/images/change.png', ['style'=>"width:16px;"]); ?> Change ODF</a>
        <br />
        <a onclick="reservedToComm($('#CONTEXT_ROW_IND').val());" style="cursor: pointer;" id="contextComm" class="list-group-item"><?= Html::img('@web/web/images/commercial.png', ['style'=>"width:16px;"]); ?> Reserve to Comm. Dep.</a>
        <br />
        <a onclick="exchInfo($('#CONTEXT_ROW_IND').val());" style="cursor: pointer;" class="list-group-item"><?= Html::img('@web/web/images/exch.png', ['style'=>"width:16px;"]); ?> Exchange Info</a>
        <a onclick="deviceView($('#CONTEXT_ROW_IND').val());" style="cursor: pointer;" class="list-group-item"><?= Html::img('@web/web/images/device.png', ['style'=>"width:16px;"]); ?> Local Device</a>
        <br />
        <a onclick="exportPDF($('#CONTEXT_ROW_IND').val());" style="cursor: pointer;" class="list-group-item"><?= Html::img('@web/web/images/pdf.png', ['style'=>"width:16px;"]); ?> Export PDF</a>
        <a onclick="exportExcel($('#CONTEXT_ROW_IND').val());" style="cursor: pointer;" class="list-group-item"><?= Html::img('@web/web/images/excel.png', ['style'=>"width:16px;"]); ?> Export Excel</a>
        <br />
        <a onclick="refreshPage($('#CONTEXT_ROW_IND').val());" style="cursor: pointer;" class="list-group-item"><?= Html::img('@web/web/images/refresh.png', ['style'=>"width:16px;"]); ?> Refresh</a>
        <input type="hidden" id="CONTEXT_ROW_IND" value="-1">
      </div>
    </div>
  </div>
</div>
<!-- context -->

<?php require("index/contextModules.php"); ?>

<script type="text/javascript">

function activateRow(rowId)
{
  $(".selectedRow").removeClass("selectedRow");
  $("#"+rowId).addClass("selectedRow");
}

function modalShow(rowId)
{
  activateRow(rowId);
  var row = document.getElementById("CONTEXT_ROW_IND");
  row.value = rowId;
  if(isRowAssigned(rowId))
  {
    document.getElementById("contextAssign").style.display = "none";
    document.getElementById("contextModify").style.display = "block";
    document.getElementById("contextEmpty").style.display = "block";
    document.getElementById("contextComm").style.display = "none";

  }
  else
  {
    document.getElementById("contextAssign").style.display = "block";
    document.getElementById("contextModify").style.display = "none";
    document.getElementById("contextEmpty").style.display = "none";
    document.getElementById("contextComm").style.display = "block";
  }

  $('#contextModal').modal('show');
}

function isRowAssigned(rowId)
{
  var peerAbbr = $("#"+rowId+" .PEER_ABBR").text();
  var peerDevice = $("#"+rowId+" .PEER_DEVICE").text();
  var peerInt = $("#"+rowId+" .PEER_INTERFACE").text();
  var peerLabel = $("#"+rowId+" .PEER_LABEL").text();

  if( (peerAbbr === "") && (peerDevice === "") && (peerInt === "") && (peerLabel === "") )
      return false;
  else
      return true;
}

function assignInterface(rowId)
{
 var Area = $("#"+rowId+" .AREA").text();
 var Abbr = $("#"+rowId+" .ABBR").text();
 var Device = $("#"+rowId+" .DEVICE").text();
 var InterfaceType = $("#"+rowId+" .INTERFACE_TYPE").text();
 var Interface = $("#"+rowId+" .INTERFACE").text();
 var Module = $("#"+rowId+" .MODULE").text();

 alert(Area +Abbr + Device +Interface +InterfaceType +Module);

}

function modifyInterface(rowId)
{

}

function emptyInterface(rowId)
{

}

function changeModule(rowId)
{

}

function changeIntType(rowId)
{

}

function viewODF(rowId)
{

}

function changeODF(rowId)
{

}

function reservedToComm(rowId)
{

}

function exchInfo(rowId)
{

}

function deviceView(rowId)
{

}

function exportPDF(rowId)
{

}

function exportExcel(rowId)
{

}

function refreshPage(rowId)
{

}


</script>

<!-- context -->
