<!-- Modal -->
<div class="modal fade" id="newSaloonModal" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:450px;">
        <div class="modal-content">

            <div class="modal-header bg-success text-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="newSaloonModalTitle"></h4>
            </div>
            <form method="post" action=<?= Yii::$app->request->baseUrl . "/sitex/add_saloon"; ?>>
                <div class="modal-body">
                    <!-- body -->
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                    <input type="hidden" id="newSaloonExchId" name="saloon[exchId]" value="-1">
                    <input type="hidden" id="newSaloonESRender" name="saloon[exchSite]" value="0">

                    <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Building</span>
                        <input type="text" name="saloon[building]" class="form-control" style="height:50px;width:150px;" value="" required>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Floor</span>
                        <input type="text"  name="saloon[floor]" class="form-control" style="height:50px;width:150px;" value="" required>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Saloon</span>
                        <input type="text"  name="saloon[saloon]" class="form-control" style="height:50px;width:150px;" value="" required>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Saloon Width</span>
                        <input type="text" name="saloon[width]" class="form-control" style="height:50px;width:80px;" value="10" required>
                        <span class="input-group-addon" style="height: 50px; width:70px;">Meter</span>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Saloon Height</span>
                        <input type="text"  name="saloon[height]" class="form-control" style="height:50px;width:80px;" value="10" required>
                        <span class="input-group-addon" style="height: 50px; width:70px;">Meter</span>
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