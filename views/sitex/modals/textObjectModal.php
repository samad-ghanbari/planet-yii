<!-- Modal -->
<div class="modal fade" id="textObjectModal" role="dialog">
  <div class="modal-dialog modal-lg" style="max-width:450px;">
      <div class="modal-content">

        <div class="modal-header bg-primary text-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Text Modification</h4>
        </div>

        <div class="modal-body">
          <!-- body -->
          <input type="hidden" id="modalTextObjectId"  value="-1">

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">Font Size</span>
            <input type="text" id="modalTextObjectFs"  class="form-control" style="height:50px;width:80px;" value="-1" required>
            <span class="input-group-addon" style="height: 50px; width:50px;">px</span>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">Text</span>
            <input type="text" id="modalTextObjectText"  class="form-control" style="height:50px;width:130px;" value="-1" required>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:80px;">Degree</span>
            <input type="text" id="modalTextObjectRotation" class="form-control" style="height:50px;width:80px;" value="-1" required>
            <span class="input-group-addon" style="height: 50px; width:90px;">clockwise</span>
          </div>
        </div>
        <div class="modal-footer">
          <button onclick="textObjectModification()" style="min-width: 80px;float:right;" class="btn btn-primary">Confirm</button>
          <button onclick="textObjectRemove()" style="min-width: 80px; float:left;" class="btn btn-danger">Remove</button>
        </div>

      </div>
  </div>
</div>
<!-- Modal -->
<?php
$bPath = Yii::$app->request->baseUrl;
$js = <<< JS

function textObjectModification()
{
    var objectId = $("#modalTextObjectId").val();
    var font_size = $("#modalTextObjectFs").val();
    var text = $("#modalTextObjectText").val();
    var rotation = $("#modalTextObjectRotation").val();
    if(text == "")
    {
      alert("text cannot be empty.");
      return;
    }
    if(font_size < 8 || font_size > 60)
    {
      alert("inappropriate font size are provided.");
      return;
    }
    $.ajax(
        {
        url: "$bPath/sitex/text_object_modification",
        type:"POST",
        data:{'id':objectId, 'font_size':font_size, 'text':text, 'rotation':rotation},

        success: function(ok)
            { 
            if(ok == true)
            {
              // modify object
              var parent = $("#objectId-"+objectId);
              parent.css('-webkit-transform','rotate('+rotation+'deg)'); 
              parent.css('-moz-transform','rotate('+rotation+'deg)');
              parent.css('transform','rotate('+rotation+'deg)');

              var object = $("#objectId-"+objectId+" .object");
              object.css("font-size",font_size+"px");
              object.html(text);

              var attr = objectId+","+font_size+","+text+","+rotation;
              $("#objectId-"+objectId+" .object-edit").attr("attr", attr);


              $("#textObjectModal").modal('hide');
            }
            else
                alert("Cannot save the text object new properties.");
            }
        }
    );
}

function textObjectRemove()
{
  var ret = confirm("Do you really want to remove the object?");
  if(ret == true)
  {
    var objectId = $("#modalTextObjectId").val();

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
              $("#textObjectModal").modal('hide');
            }
            else
                alert("Cannot remove the text object.");
            }
        }
    );
  }
}

JS;
$this->registerJs($js, Yii\web\View::POS_END);
?>