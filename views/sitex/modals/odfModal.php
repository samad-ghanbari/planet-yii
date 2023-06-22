<!-- Modal -->
<div class="modal fade" id="odfModal" role="dialog">
  <div class="modal-dialog modal-lg" style="max-width:450px;">
      <div class="modal-content">

        <div class="modal-header bg-primary text-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">ODF Modification</h4>
        </div>

        <div class="modal-body">
          <!-- body -->
          <input type="hidden" id="modalOdfId" value="-1">

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">ODF No</span>
            <input type="text" id="modalOdfNo" class="form-control" style="height:50px;width:130px;" value="-1" required>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">ODF Width</span>
            <input type="text" id="modalOdfWidth" class="form-control" style="height:50px;width:80px;" value="-1" required>
            <span class="input-group-addon" style="height: 50px; width:50px;">cm</span>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">ODF Height</span>
            <input type="text" id="modalOdfHeight"  class="form-control" style="height:50px;width:80px;" value="-1" required>
            <span class="input-group-addon" style="height: 50px; width:50px;">cm</span>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">ODF Depth</span>
            <input type="text" id="modalOdfDepth" class="form-control" style="height:50px;width:80px;" value="-1" required>
            <span class="input-group-addon" style="height: 50px; width:50px;">cm</span>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">ODF Row</span>
            <input type="text" id="modalOdfRow"  class="form-control" style="height:50px;width:130px;" value="-1" required>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">ODF Column</span>
            <input type="text" id="modalOdfColumn"  class="form-control" style="height:50px;width:130px;" value="-1" required>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:80px;">Degree</span>
            <input type="text" id="modalOdfRotation"  class="form-control" style="height:50px;width:80px;" value="-1" required>
            <span class="input-group-addon" style="height: 50px; width:90px;">clockwise</span>
          </div>
        </div>
        <div class="modal-footer">
          <button onclick="odfModification()" style="min-width: 80px;float:right;" class="btn btn-primary">Confirm</button>
          <button onclick="odfRemove()" style="min-width: 80px; float:left;" class="btn btn-danger">Remove</button>
        </div>

      </div>
  </div>
</div>
<!-- Modal -->
<?php
$bPath = Yii::$app->request->baseUrl;
$js = <<< JS

function odfModification()
{
    var odfId = $("#modalOdfId").val();
    var odfNo =  $("#modalOdfNo").val();
    var width = $("#modalOdfWidth").val();
    var height = $("#modalOdfHeight").val();
    var depth = $("#modalOdfDepth").val();
    var row = $("#modalOdfRow").val();
    var column = $("#modalOdfColumn").val();
  
    if(width < 10 || height < 10 || depth < 10)
    {
      alert("inappropriate ODF size are provided.");
      return;
    }
    $.ajax(
        {
        url: "$bPath/sitex/odf_modification",
        type:"POST",
        data:{'id':odfId, 'odfNo':odfNo, 'width':width, 'height':height, 'depth':depth, 'row':row, 'column':column, 'rotation':rotation},

        success: function(ok)
            {
            if(ok == true)
            {
              // modify odf
              var parent = $("#odfId-"+odfId);
              //parent.css({ WebkitTransform: 'rotate(' + degree + 'deg)'});
              //parent.css({transform: "rotate("+rotation+"deg)"});
              parent.css('-webkit-transform','rotate('+rotation+'deg)'); 
              parent.css('-moz-transform','rotate('+rotation+'deg)');
              parent.css('transform','rotate('+rotation+'deg)');
              parent.css("width",width);

              var rc = $("#odfId-"+odfId+" .odf-rc");
              rc.html(row+"-"+column);

              var rc = $("#odfId-"+odfId+" .odf .odfNo");
              rc.html("ODF: "+column);

              var odf = $("#odfId-"+odfId+" .odf");
              odf.css("height",depth);

              var attr = odfId+","+odfNo+","+width+","+height+","+depth+","+row+","+column+","+rotation;
              $("#odfId-"+odfId+" .odf-edit").attr("attr", attr);


              $("#odfModal").modal('hide');
            }
            else
                alert("Cannot save the ODF new properties.");
            }
        }
    );
}

function odfRemove()
{
  var ret = confirm("Do you really want to remove the ODF?");
  if(ret == true)
  {
    var odfId = $("#modalOdfId").val();

    $.ajax(
        {
        url: "$bPath/sitex/odf_remove",
        type:"POST",
        data:{'id':odfId},

        success: function(ok)
            { 
            if(ok == true)
            {
              // remove odf
              var parent = $("#odfId-"+odfId);
              parent.css("display", "none"); 
              $("#odfModal").modal('hide');
            }
            else
                alert("Cannot remove the ODF.");
            }
        }
    );
  }
}

JS;
$this->registerJs($js, Yii\web\View::POS_END);
?>