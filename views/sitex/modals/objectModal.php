<!-- Modal -->
<div class="modal fade" id="objectModal" role="dialog">
  <div class="modal-dialog modal-lg" style="max-width:450px;">
      <div class="modal-content">

        <div class="modal-header bg-primary text-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Object Modification</h4>
        </div>

        <div class="modal-body">
          <!-- body -->
          <input type="hidden" id="modalObjectId"  value="-1">

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">Object Width</span>
            <input type="text" id="modalObjectWidth" class="form-control" style="height:50px;width:80px;" value="-1" required>
            <span class="input-group-addon" style="height: 50px; width:50px;">cm</span>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">Object Height</span>
            <input type="text" id="modalObjectHeight"  class="form-control" style="height:50px;width:80px;" value="-1" required>
            <span class="input-group-addon" style="height: 50px; width:50px;">cm</span>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">Object Depth</span>
            <input type="text" id="modalObjectDepth" name="Object[depth]" class="form-control" style="height:50px;width:80px;" value="-1" required>
            <span class="input-group-addon" style="height: 50px; width:50px;">cm</span>
          </div>


          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:80px;">Degree</span>
            <input type="text" id="modalObjectRotation" name="Object[rotation]" class="form-control" style="height:50px;width:80px;" value="-1" required>
            <span class="input-group-addon" style="height: 50px; width:90px;">clockwise</span>
          </div>
        </div>
        <div class="modal-footer">
          <button onclick="objectModification()" style="min-width: 80px;float:right;" class="btn btn-primary">Confirm</button>
          <button onclick="objectRemove()" style="min-width: 80px; float:left;" class="btn btn-danger">Remove</button>
        </div>

      </div>
  </div>
</div>
<!-- Modal -->
<?php
$bPath = Yii::$app->request->baseUrl;
$js = <<< JS

function objectModification()
{
    var objectId = $("#modalObjectId").val();
    var width = $("#modalObjectWidth").val();
    var height = $("#modalObjectHeight").val();
    var depth = $("#modalObjectDepth").val();
    var rotation = $("#modalObjectRotation").val();
    if(width < 10 || height < 10 || depth < 10)
    {
      alert("inappropriate object size are provided.");
      return;
    }
    $.ajax(
        {
        url: "$bPath/sitex/object_modification",
        type:"POST",
        data:{'id':objectId, 'width':width, 'height':height, 'depth':depth, 'rotation':rotation},

        success: function(ok)
            {
            if(ok == true)
            {
              // modify object
              var parent = $("#objectId-"+objectId);
              //parent.css({ WebkitTransform: 'rotate(' + degree + 'deg)'});
              //parent.css({transform: "rotate("+rotation+"deg)"});
              parent.css('-webkit-transform','rotate('+rotation+'deg)'); 
              parent.css('-moz-transform','rotate('+rotation+'deg)');
              parent.css('transform','rotate('+rotation+'deg)');
              parent.css("width",width);

              var object = $("#objectId-"+objectId+" .object");
              object.css("height",depth);

              var attr = objectId+","+width+","+height+","+depth+","+rotation;
              $("#objectId-"+objectId+" .object-edit").attr("attr", attr);


              $("#objectModal").modal('hide');
            }
            else
                alert("Cannot save the object new properties.");
            }
        }
    );
}

function objectRemove()
{
  var ret = confirm("Do you really want to remove the object?");
  if(ret == true)
  {
    var objectId = $("#modalObjectId").val();

    $.ajax(
        {
        url: "$bPath/sitex/object_remove",
        type:"POST",
        data:{'id':objectId},

        success: function(ok)
            { 
            if(ok == true)
            {
              // modify object
              var parent = $("#objectId-"+objectId);
              parent.css("display", "none"); 
              $("#objectModal").modal('hide');
            }
            else
                alert("Cannot remove the object.");
            }
        }
    );
  }
}

JS;
$this->registerJs($js, Yii\web\View::POS_END);
?>