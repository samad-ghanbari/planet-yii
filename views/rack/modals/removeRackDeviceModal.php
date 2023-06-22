<!-- Modal -->
<div class="modal fade" id="removeRackDeviceModal" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:600px;">
        <div class="modal-content">

            <div class="modal-header bg-danger text-danger">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Remove Device</h4>
            </div>
            <form method="post" action=<?= Yii::$app->request->baseUrl . "/rack/remove_device"; ?> >
                <div class="modal-body">
                    <!-- body -->
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                    <input type="hidden" id="removeRackDevId" name="rackdev[id]" value="-1" />

                    <div class="input-group" style="max-width: 500px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:150px;text-align: left;">Exchange/Site</span>
                        <input type="text" id="removeRackDevAbbr" name="rackdev[abbr]" class="form-control" style="height:50px;width:300px;"  value="" required readonly>
                    </div>

                    <div class="input-group" style="max-width: 500px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:150px;text-align: left;">Shelf</span>
                        <input type="text" id="removeRackDevShelf" name="rackdev[shelf]" class="form-control" style="height:50px;width:300px;"  value="" required  readonly>
                    </div>

                    <div class="input-group" style="max-width: 500px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:150px;text-align: left;">Device</span>
                        <input type="text" id="removeRackDevDev" name="rackdev[dev]" class="form-control" style="height:50px;width:300px;"  value="" required  readonly>
                    </div>

                    <div class="input-group" style="max-width: 500px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:150px;text-align: left;">Name</span>
                        <input type="text" id="removeRackDevDevName" name="rackdev[devname]" class="form-control" style="height:50px;width:300px;"  value="" required  readonly>
                    </div>

                </div>
                <div class="modal-footer">
                    <button style="min-width: 80px;" class="btn btn-danger">Remove</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->