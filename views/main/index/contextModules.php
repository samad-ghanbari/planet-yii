<?php

use yii\helpers\Html;
?>

<!-- Assign Interface -->
<div class="box_shadow modal fade" id="AssignIntModal" role="dialog">
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
<!-- Assign Interface-->

<!-- Modify Interface -->
<div class="box_shadow modal fade" id="ModifyIntModal" role="dialog">
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
<!-- Modify Interface -->


<!-- Empty Interface -->
<div class="box_shadow modal fade" id="EmptyIntModal" role="dialog">
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
<!-- Empty Interface -->


<!-- Change Module -->
<div class="box_shadow modal fade" id="ChangeModuleModal" role="dialog">
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
<!-- Change Module -->


<!-- Change Interface Type -->
<div class="box_shadow modal fade" id="ChangeIntTypeModal" role="dialog">
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
<!-- Change Interface Type -->

<!-- View ODF -->
<div class="box_shadow modal fade" id="ViewOdfModal" role="dialog">
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
<!-- VIEW ODF -->


<!-- Change ODF -->
<div class="box_shadow modal fade" id="ChangeOdfModal" role="dialog">
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
<!-- Change ODF -->


<!-- Reserve Comm -->
<div class="box_shadow modal fade" id="ReserveCommModal" role="dialog">
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
<!-- Reserve Comm -->

<!-- Exch Info -->
<div class="box_shadow modal fade" id="ExchInfoModal" role="dialog">
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
<!-- Exch Info -->


<!-- local device -->
<div class="box_shadow modal fade" id="LocalDeviceModal" role="dialog">
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
<!-- local device -->


<!-- export pdf -->
<div class="box_shadow modal fade" id="ExportPdfModal" role="dialog">
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
<!-- export pdf -->


<!-- export excel -->
<div class="box_shadow modal fade" id="ExportExcelModal" role="dialog">
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
<!-- export excel -->
