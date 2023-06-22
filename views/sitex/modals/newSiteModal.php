<!-- Modal -->
<div class="modal fade" id="newSiteModal" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:450px;">
        <div class="modal-content">

            <div class="modal-header bg-success text-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Site</h4>
            </div>
            <form method="post" onsubmit="return newSiteFormvalidate()" action=<?= Yii::$app->request->baseUrl . "/sitex/add_new_site"; ?>>
                <div class="modal-body">
                    <!-- body -->
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                    <input type="hidden" id="newSiteMotherId" name="exch[mother_id]" value="-1" />

                    <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Mother</span>
                        <input type="text" id="newSiteMother" name="exch[mother]" class="form-control" style="height:50px;width:200px;"  value="" required readonly>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Cascade</span>
                        <input type="text" id="newSiteCascade" name="exch[site_cascade]" class="form-control" style="height:50px;width:200px;"  value="" required readonly>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Node</span>
                        <input type="text" id="newSiteNode" name="exch[site_node]" class="form-control" style="height:50px;width:200px;"  value="" required>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Name</span>
                        <input type="text" id="newSiteNameId"  name="exch[name]" class="form-control" style="height:50px;width:200px;" required>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Abbr</span>
                        <input type="text" id="newSiteAbbrId" name="exch[abbr]" class="form-control" style="height:50px;width:200px;" required>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Uplink Site</span>
                        <select id="newSiteUplinkId" name="exch[uplink_id]" class="form-control" style="height:50px;width:200px;">
                        </select>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Address</span>
                        <textarea name="exch[address]" id="newSiteAddressId" class="form-control" style="width:200px;" rows="3" ></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button style="min-width: 80px;" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<?php
$js = <<< JS

function newSiteFormvalidate()
{
    var node = $("#newSiteNode").val();
    var mother = $("#newSiteMotherId").val();
    var uplink = $("#newSiteUplinkId").val();
    if(isNaN(node))
        {
            alert("Node value must be a number.");
            return false;
        }
    if(mother == uplink)
        {
            if(node != 1)
                {
                    alert("First node of the cascade must be the node valued number 1.");
                    return false;
                }
        }
    
    return true;
}

JS;
$this->registerJs($js, Yii\web\View::POS_END);
?>