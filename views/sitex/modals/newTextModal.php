<!-- Modal -->
<div class="modal fade" id="newTextModal" role="dialog">
  <div class="modal-dialog modal-lg" style="max-width:450px;">
    <div class="modal-content">

      <div class="modal-header bg-success text-success">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="newTextModalTitle"></h4>
      </div>
      <form method="post" action=<?= Yii::$app->request->baseUrl . "/sitex/add_new_text"; ?>>
        <div class="modal-body">
          <!-- body -->
          <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
          <input type="hidden" id="newTextSaloonId" name="text[saloon_id]" value="-1">
            <input type="hidden" id="newTextESRender" name="text[exchSite]" value="0">

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">Font Size</span>
            <input type="text" name="text[font_size]" class="form-control" style="height:50px;width:80px;" value="14" required>
            <span class="input-group-addon" style="height: 50px; width:50px;">px</span>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">Text</span>
            <input type="text" name="text[text]" class="form-control" style="height:50px;width:130px;" value="" required>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">Top</span>
            <input type="text" name="text[top]" class="form-control" style="height:50px;width:80px;" value="0" required>
            <span class="input-group-addon" style="height: 50px; width:50px;">cm</span>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:120px;">Left</span>
            <input type="text" name="text[left]" class="form-control" style="height:50px;width:80px;" value="0" required>
            <span class="input-group-addon" style="height: 50px; width:50px;">cm</span>
          </div>

          <div class="input-group" style="max-width: 400px; min-width: 100;height: 50px;margin: auto;">
            <span class="input-group-addon" style="height: 50px; width:80px;">Degree</span>
            <input type="text" name="text[rotation]" class="form-control" style="height:50px;width:80px;" value="0" required>
            <span class="input-group-addon" style="height: 50px; width:90px;">clockwise</span>
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