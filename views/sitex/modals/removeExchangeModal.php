<!-- Modal -->
<div class="modal fade" id="removeExchangeModal" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:450px;">
        <div class="modal-content">

            <div class="modal-header bg-danger text-danger">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Remove Exchange</h4>
            </div>
            <form method="post" action=<?= Yii::$app->request->baseUrl . "/sitex/remove_exchange"; ?> onsubmit="$('#removeExchangeModal').modal('hide'); return confirm('Are you sure you want to REMOVE the exchange?');">
                <div class="modal-body">
                    <!-- body -->
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                    <input type="hidden" id="removeExchId" name="exch[id]" value="-1" />


                    <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Area</span>
                        <input type="text" id="removeExchArea" name="exch[area]" class="form-control" style="height:50px;width:200px;"  value="-1" required readonly>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Name</span>
                        <input type="text" id="removeExchName"  name="exch[name]" class="form-control" style="height:50px;width:200px;" required readonly>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Abbr</span>
                        <input type="text" id="removeExchAbbr" name="exch[abbr]" class="form-control" style="height:50px;width:200px;" required readonly>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Type</span>
                        <select name="exch[type]" id="removeExchType" class="form-control" style="height:50px;width:200px;" disabled>
                            <option style="direction: rtl;" value="1">اداره کل</option>
                            <option style="direction: rtl;" value="2">مرکز</option>
                        </select>
                    </div>

                    <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">Address</span>
                        <textarea name="exch[address]" id="removeExchAddress" class="form-control" style="width:200px; direction:rtl;" rows="3" readonly></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button style="min-width: 80px;" type="confirm" class="btn btn-danger">Remove</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->