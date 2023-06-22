<!-- Modal -->
<div class="modal fade" id="newExchangeModal" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:450px;">
        <div class="modal-content">

            <div class="modal-header bg-success text-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Exchange</h4>
            </div>
            <form method="post" action=<?= Yii::$app->request->baseUrl . "/sitex/add_new_exchange"; ?>>
                <div class="modal-body">
                    <!-- body -->
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />

                    <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Area</span>
                        <input type="text" id="newExchAreaId" name="exch[area]" class="form-control" style="height:50px;width:200px;"  value="-1" required readonly>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Name</span>
                        <input type="text" id="newExchNameId"  name="exch[name]" class="form-control" style="height:50px;width:200px;" required>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Abbr</span>
                        <input type="text" id="newExchAbbrId" name="exch[abbr]" class="form-control" style="height:50px;width:200px;" required>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Type</span>
                        <select name="exch[type]" class="form-control" style="height:50px;width:200px;">
                            <option style="direction: rtl;" value="1">اداره کل</option>
                            <option style="direction: rtl;" value="2" selected>مرکز</option>
                        </select>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Address</span>
                        <textarea name="exch[address]" id="newExchAddressId" class="form-control" style="width:200px;" rows="3" ></textarea>
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