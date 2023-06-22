<!-- Modal -->
<div class="modal fade" id="newOdfModal" role="dialog">
  <div class="modal-dialog modal-lg" style="max-width:450px;">
  <form method="post" action="<?= Yii::$app->request->baseUrl."/sitex/add_new_odf"; ?>">
      <div class="modal-content">

        <div class="modal-header bg-success text-success">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New ODF</h4>
        </div>

        <div class="modal-body">
          <!-- body -->
          <input type="hidden" id="newOdfModalSaloonId" name="odf[saloon_id]" value="-1">
          <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            <input type="hidden" id="newOdfESRender" name="odf[exchSite]" value="0">

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">ODF No</span>
            <input type="text" class="form-control" name="odf[odf_no]" style="height:50px;width:130px;" value="" required autofocus>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">POS Count</span>
            <input type="text"  class="form-control" name="odf[pos_count]" style="height:50px;width:130px;" value="8" required>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">ODF Width</span>
            <input type="text" class="form-control" name="odf[width]" style="height:50px;width:80px;" value="" required>
            <span class="input-group-addon" style="height: 50px; width:50px;">cm</span>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">ODF Height</span>
            <input type="text" name="odf[height]"  class="form-control" style="height:50px;width:80px;" value="" required>
            <span class="input-group-addon" style="height: 50px; width:50px;">cm</span>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">ODF Depth</span>
            <input type="text" name="odf[depth]" class="form-control" style="height:50px;width:80px;" value="" required>
            <span class="input-group-addon" style="height: 50px; width:50px;">cm</span>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">ODF Row</span>
            <input type="text" name="odf[row]"  class="form-control" style="height:50px;width:130px;" value="" required>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">ODF Column</span>
            <input type="text" name="odf[column]"  class="form-control" style="height:50px;width:130px;" value="" required>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:80px;">Degree</span>
            <input type="text"  name="odf[rotation]" class="form-control" style="height:50px;width:80px;" value="0" required>
            <span class="input-group-addon" style="height: 50px; width:90px;">clockwise</span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="confirm" style="min-width: 80px;float:right;" class="btn btn-success">Add</button>
        </div>
      </div>
  </form>
  </div>
</div>
<!-- Modal -->
