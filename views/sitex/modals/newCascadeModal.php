<!-- Modal -->
<div class="modal fade" id="newCascadeModal" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:450px;">
        <div class="modal-content">

            <div class="modal-header bg-success text-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Cascade Site</h4>
            </div>
            <form method="post" action=<?= Yii::$app->request->baseUrl . "/sitex/add_new_cascade"; ?>>
                <div class="modal-body">
                    <!-- body -->
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                    <input type="hidden" id="newCascadeMotherId" name="exch[mother_id]" value="-1" />

                    <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Mother</span>
                        <input type="text" id="newCascadeMother" name="exch[mother]" class="form-control" style="height:50px;width:200px;"  value="" required readonly>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Uplink</span>
                        <input type="text" id="newCascadeUplink" name="exch[uplink]" class="form-control" style="height:50px;width:200px;"  value="" required readonly>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Name</span>
                        <input type="text" id="newCascadeNameId"  name="exch[name]" class="form-control" style="height:50px;width:200px;" required>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Abbr</span>
                        <input type="text" id="newCascadeAbbrId" name="exch[abbr]" class="form-control" style="height:50px;width:200px;" required>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Address</span>
                        <textarea name="exch[address]" id="newCascadeAddressId" class="form-control" style="width:200px;" rows="3" ></textarea>
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

JS;
$this->registerJs($js, Yii\web\View::POS_END);
?>