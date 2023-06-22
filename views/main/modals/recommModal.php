<!-- Modal -->
<div class="modal fade" id="recommModal" role="dialog">
    <div class="modal-dialog modal-lg" style="width:80%;">
        <div class="modal-content">

            <form method="post"  action=<?= Yii::$app->request->baseUrl . "/main/add_recommendation"; ?> onsubmit="return validate_recomm_form()"  >
            <div class="modal-body">

                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="bg-wt padding-5" style="width:250px; margin:0 auto;">
                    <h5 class="text-center"><i class="fa fa-user text-primary" ></i><?= " ".$session['user']['name']." ".$session['user']['lastname']; ?></h5>
                    <h5 class="text-center text-color" style="margin:10px;"><?php if ($session['user']['province_id'] == 0) echo "Iran Privileges";
                        else echo $session['user']['province'] . " Province"; ?></h5>
                    <?php if ($session['user']['province_id'] > 0) { ?>
                        <h5 style="margin:10px;" class="text-center text-color"><?= $session['user']['office'] . " Office"; ?></h5>
                    <?php } ?>
                </div>

                <!-- body -->
                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                <input type="hidden" id="new-recomm-user-id" name="recomm[user_id]" value="<?= $session['user']['id'] ?>" />

                <div class="form-group" >
                    <label for="recomTA" class="text-primary">New Recommendation</label>
                    <textarea name="recomm[recomm]" id="recomTA" class="form-control text-primary text-right" rows="5" ></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" style="min-width: 80px; color:white;" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->

<?php
$bPath = Yii::$app->request->baseUrl;
$user = json_encode($session['user']);
$epmJs = <<< JS

function addRecomm()
{
    $("#new-recomm").val("");
    $("#recommModal").modal("show");
}

function validate_recomm_form()
{
    var rcm = $("#recomTA").val();
    if(rcm == "")
        {
            alert("Recommendation message can not be empty.");
            return false;   
        }
    else
        return true;
}
JS;
$this->registerJs($epmJs, Yii\web\View::POS_END);
?>