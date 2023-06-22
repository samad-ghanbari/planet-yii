<!-- Modal -->
<div class="modal fade" id="editRackDeviceModal" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:550px;">
        <div class="modal-content">

            <div class="modal-header bg-primary text-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Device</h4>
            </div>
            <form method="post" action=<?= Yii::$app->request->baseUrl . "/rack/edit_device"; ?> onsubmit="return editRackDevValidation()">
                <div class="modal-body">
                    <!-- body -->
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                    <input type="hidden" id="editRackDevId" name="rackdev[id]" value="-1" />

                    <div class="input-group" style="max-width: 500px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:150px;text-align:left;">Exchange/Site</span>
                        <input type="text" id="editRackDevAbbr" name="rackdev[abbr]" class="form-control" style="height:50px;width:300px;"  value="" required readonly>
                    </div>

                    <div class="input-group" style="max-width: 500px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:150px;text-align:left;">Rack</span>
                        <select id="editRackDevRack" name="rackdev[rack]" class="form-control" style="height:50px;width:300px;" required>
                        </select>
                    </div>

                    <div class="input-group" style="max-width: 500px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:150px;text-align:left;">Shelf</span>
                        <input type="text" id="editRackDevShelf" name="rackdev[shelf]" class="form-control" style="height:50px;width:300px;"  value="" required>
                    </div>

                    <div class="input-group" style="max-width: 500px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:150px;text-align:left;">Device</span>
                        <select id="editRackDevDevices" name="rackdev[device]" class="form-control" style="height:50px;width:300px;" required>
                        </select>
                    </div>

                    <div class="input-group" style="max-width: 500px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:150px;text-align:left;">Purchase</span>
                        <select id="editRackDevPurchases" name="rackdev[purchase]" class="form-control" style="height:50px;width:300px;" required>
                        </select>
                    </div>

                    <div class="input-group" style="max-width: 500px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:150px;text-align:left;">Desc</span>
                        <textarea name="rackdev[desc]" id="editRackDevDesc" class="form-control" style="width:300px;" rows="3" ></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button style="min-width: 80px;" class="btn btn-primary">Modify</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<?php
$bPath = Yii::$app->request->baseUrl;
$js = <<< JS

function editRackDevValidation()
{
    var shelf = $("#editRackDevShelf").val();
    var device = $("#editRackDevDevices").val();
    var purchase = $("#editRackDevPurchases").val();
    
    if(isNaN(shelf))
        {
            alert("Error! Shelf Number is not valid.");
            return false;
        }

    if((device < 0) || (device == null) )
        {
            alert("Error! Select a device please.");
            return false;
        }
    
    if( (purchase < 0) || (purchase == null) )
    {
        alert("Error! Select a device purchase please.");
        return false;
    }
        
    return true;
}

JS;
$this->registerJs($js, Yii\web\View::POS_END);
?>