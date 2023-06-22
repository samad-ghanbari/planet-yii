<!-- Modal -->
<div class="modal fade" id="saloonRemoveModal" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:450px;">
        <div class="modal-content">

            <div class="modal-header bg-danger text-danger">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" > Remove Saloon</h4>
            </div>
                <div class="modal-body">
                    <!-- body -->
                    <input type="hidden" id="saloonRemoveModalId"  value="-1">

                    <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Building</span>
                        <input type="text" id="saloonRemoveModalBuilding" class="form-control" style="height:50px;width:150px;" value=""  readonly>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Floor</span>
                        <input type="text" id="saloonRemoveModalFloor" class="form-control" style="height:50px;width:150px;" value=""  readonly>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Saloon</span>
                        <input type="text" id="saloonRemoveModalSaloon"  class="form-control" style="height:50px;width:150px;" value=""  readonly>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Saloon Width</span>
                        <input type="text" id="saloonRemoveModalWidth"  class="form-control" style="height:50px;width:80px;" value="10"  readonly>
                        <span class="input-group-addon" style="height: 50px; width:70px;">Meter</span>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Saloon Height</span>
                        <input type="text" id="saloonRemoveModalHeight"  class="form-control" style="height:50px;width:80px;" value="10" readonly>
                        <span class="input-group-addon" style="height: 50px; width:70px;">Meter</span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button onclick="rmSaloon()" style="min-width: 80px;" class="btn btn-danger">Remove</button>
                </div>
        </div>
    </div>
</div>
<!-- Modal -->

<?php
$bPath = Yii::$app->request->baseUrl;
$js = <<< JS

function rmSaloon()
{
    var ret = confirm('Are you sure you want to REMOVE the saloon?');
    if(ret == false)
    {
        $("#saloonRemoveModal").modal("hide");
        return;
    }

    var saloonId = $("#saloonRemoveModalId").val(); 

    $.ajax(
        {
        url: "$bPath/sitex/remove_saloon",
        type:"POST",
        data:{'id':saloonId},
        success: function(ok)
            {
            if(ok == true)
            {
              // remove saloon
              $("#accordion-"+saloonId).css("display", "none"); 
              
            }
            else
                alert("Cannot remove the Saloon. The saloon must be empty.");

                $("#saloonRemoveModal").modal('hide');
            }
        }
    );
  
}
JS;
$this->registerJs($js, Yii\web\View::POS_END);
?>