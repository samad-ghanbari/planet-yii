<!-- Modal -->
<div class="modal fade" id="rackModal" role="dialog">
  <div class="modal-dialog modal-lg" style="max-width:450px;">
      <div class="modal-content">

        <div class="modal-header bg-primary text-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Rack Modification</h4>
        </div>

        <div class="modal-body">
          <!-- body -->
          <input type="hidden" id="modalRackId" name="Rack[id]" value="-1">

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">Rack Width</span>
            <input type="text" id="modalRackWidth" name="Rack[width]" class="form-control" style="height:50px;width:80px;" value="-1" required>
            <span class="input-group-addon" style="height: 50px; width:50px;">cm</span>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">Rack Height</span>
            <input type="text" id="modalRackHeight" name="Rack[height]" class="form-control" style="height:50px;width:80px;" value="-1" required>
            <span class="input-group-addon" style="height: 50px; width:50px;">cm</span>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">Rack Depth</span>
            <input type="text" id="modalRackDepth" name="Rack[depth]" class="form-control" style="height:50px;width:80px;" value="-1" required>
            <span class="input-group-addon" style="height: 50px; width:50px;">cm</span>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">Rack Row</span>
            <input type="text" id="modalRackRow" name="Rack[row]" class="form-control" style="height:50px;width:130px;" value="-1" required>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">Rack Column</span>
            <input type="text" id="modalRackColumn" name="Rack[column]" class="form-control" style="height:50px;width:130px;" value="-1" required>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:80px;">Degree</span>
            <input type="text" id="modalRackRotation" name="Rack[rotation]" class="form-control" style="height:50px;width:80px;" value="-1" required>
            <span class="input-group-addon" style="height: 50px; width:90px;">clockwise</span>
          </div>
        </div>
        <div class="modal-footer">
          <button onclick="rackModification()" style="min-width: 80px;float:right;" class="btn btn-primary">Confirm</button>
          <button onclick="rackRemove()" style="min-width: 80px; float:left;" class="btn btn-danger">Remove</button>
        </div>

      </div>
  </div>
</div>
<!-- Modal -->
<?php
$bPath = Yii::$app->request->baseUrl;
$js = <<< JS

function rackModification()
{
    var rackId = $("#modalRackId").val();
    var width = $("#modalRackWidth").val();
    var height = $("#modalRackHeight").val();
    var depth = $("#modalRackDepth").val();
    var row = $("#modalRackRow").val();
    var column = $("#modalRackColumn").val();
    var rotation = $("#modalRackRotation").val();
    if(width < 10 || height < 10 || depth < 10)
    {
      alert("inappropriate rack size are provided.");
      return;
    }
    $.ajax(
        {
        url: "$bPath/sitex/rack_modification",
        type:"POST",
        data:{'id':rackId, 'width':width, 'height':height, 'depth':depth, 'row':row, 'column':column, 'rotation':rotation},

        success: function(ok)
            {
            if(ok == true)
            {
              // modify rack
              var parent = $("#rackId-"+rackId);
              //parent.css({ WebkitTransform: 'rotate(' + degree + 'deg)'});
              //parent.css({transform: "rotate("+rotation+"deg)"});
              parent.css('-webkit-transform','rotate('+rotation+'deg)'); 
              parent.css('-moz-transform','rotate('+rotation+'deg)');
              parent.css('transform','rotate('+rotation+'deg)');
              parent.css("width",width);

              var rc = $("#rackId-"+rackId+" .rack-rc");
              rc.html(row+"-"+column);

              var rack = $("#rackId-"+rackId+" .rack");
              rack.css("height",depth);

              // var attr = [rackId, width, height, depth, row, column, rotation];
              var attr = rackId+","+width+","+height+","+depth+","+row+","+column+","+rotation;
              $("#rackId-"+rackId+" .rack-edit").attr("attr", attr);


              $("#rackModal").modal('hide');
            }
            else
                alert("Cannot save the rack new properties.");
            }
        }
    );
}

function rackRemove()
{
  var ret = confirm("Do you really want to remove the rack?");
  if(ret == true)
  {
    var rackId = $("#modalRackId").val();

    $.ajax(
        {
        url: "$bPath/sitex/rack_remove",
        type:"POST",
        data:{'id':rackId},

        success: function(ok)
            { 
            if(ok == true)
            {
              // remove rack
              var parent = $("#rackId-"+rackId);
              parent.css("display", "none"); 
              $("#rackModal").modal('hide');
            }
            else
                alert("Cannot remove the rack.");
            }
        }
    );
  }
}

JS;
$this->registerJs($js, Yii\web\View::POS_END);
?>