<!-- Modal -->
<div class="modal fade" id="newRackModal" role="dialog">
  <div class="modal-dialog modal-lg" style="max-width:450px;">
  <form method="post" action="<?= Yii::$app->request->baseUrl."/sitex/add_new_rack"; ?>">
      <div class="modal-content">

        <div class="modal-header bg-success text-success">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Rack</h4>
        </div>

        <div class="modal-body" >
          <!-- body -->
          <input type="hidden" id="newRackModalSaloonId" name="rack[saloon_id]" value="-1">
          <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            <input type="hidden" id="newRackESRender" name="rack[exchSite]" value="0">

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">Rack Width</span>
            <input type="text" name="rack[width]" class="form-control" style="height:50px;width:80px;" value="80" required>
            <span class="input-group-addon" style="height: 50px; width:50px;">cm</span>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">Rack Height</span>
            <input type="text" name="rack[height]" class="form-control" style="height:50px;width:80px;" value="200" required>
            <span class="input-group-addon" style="height: 50px; width:50px;">cm</span>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">Rack Depth</span>
            <input type="text"  name="rack[depth]" class="form-control" style="height:50px;width:80px;" value="80" required>
            <span class="input-group-addon" style="height: 50px; width:50px;">cm</span>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">Rack Row</span>
            <input type="text" name="rack[row]" class="form-control" style="height:50px;width:130px;" value="" required>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">Rack Column</span>
            <input type="text" name="rack[column]" class="form-control" style="height:50px;width:130px;" value="" required>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:80px;">Degree</span>
            <input type="text"  name="rack[rotation]" class="form-control" style="height:50px;width:80px;" value="0" required>
            <span class="input-group-addon" style="height: 50px; width:90px;">clockwise</span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" style="min-width: 80px;float:right;" class="btn btn-success">Add</button>
        </div>
      </div>
  </form>
  </div>
</div>
<!-- Modal -->