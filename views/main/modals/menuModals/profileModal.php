<!-- Modal -->
<div class="modal fade" id="profileModal" role="dialog">
    <div class="modal-dialog modal-lg" style="width:80%; max-width:500px;">
        <div class="modal-content">

            <form method="post"  action=<?= Yii::$app->request->baseUrl . "/main/edit_profile"; ?> onsubmit="return validate_ep()"  >
                <div class="modal-body">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div style="width:250px; margin:0 auto;">
                        <i class="fa fa-user fa-2x " style=" display:block; margin:auto; color:darkolivegreen;"></i>
                        <h5 class="text-center text-color" style="margin:10px;"><?php if ($session['user']['province_id'] == 0) echo "Iran Privileges";
                            else echo $session['user']['province'] . " Province"; ?></h5>
                        <?php if ($session['user']['province_id'] > 0) { ?>
                            <h5 style="margin:10px;" class="text-center text-color"><?= $session['user']['office'] . " Office"; ?></h5>
                        <?php } ?>
                    </div>

                    <!-- body -->
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                    <input type="hidden" id="epm-user-id" name="user[id]" value="<?= $session['user']['id'] ?>" />

                    <div class="input-group" style="width: 320px; height: 30px;margin: 0 auto;padding: 0;">
                        <span class="input-group-addon" style="height: 30px; width:120px;">Current Password</span>
                        <input type="password" id="epm-user-cp" name="current-pass" class="form-control" style="height:30px;width:150px;"  value="" required>
                    </div>
                    <hr style="border-color:darkolivegreen;" />
                    <div class="input-group" style="width: 320px;height: 90px;margin: auto;">
                        <span class="input-group-addon" style="height: 50px; width:120px;">User</span>
                        <input type="text" id="epm-user-name" name="user[name]" placeholder="Name" class="form-control" style="height:30px;width:200px;"  value="" required>
                        <input type="text" id="epm-user-lastname"  name="user[lastname]" placeholder="Lastname" class="form-control" style="height:30px;width:200px;" required>
                        <input type="text" id="epm-user-nid" name="user[national_id]" class="form-control" placeholder="national ID" style="height:30px;width:200px;" required>
                    </div>

                    <div class="input-group" style="width: 320px;height: 40px;margin: auto;">
                        <span class="input-group-addon" style="height: 40px; width:120px;">Area</span>
                        <select id="epm-user-da" name="user[default_area]" class="form-control" style="height:40px;width:200px;">
                            <option style="direction: rtl;" value="2">2</option>
                            <option style="direction: rtl;" value="3">3</option>
                            <option style="direction: rtl;" value="4">4</option>
                            <option style="direction: rtl;" value="5">5</option>
                            <option style="direction: rtl;" value="6">6</option>
                            <option style="direction: rtl;" value="7">7</option>
                            <option style="direction: rtl;" value="8">8</option>
                        </select>
                    </div>
                    <br/>
                    <div class="checkbox"  style="width:150px;height:30px; line-height: 30px; vertical-align: center; margin:0 auto;">
                            <input type="checkbox" value="1"  name="reset-chb" id="epm-user-rp-cb"  onchange="resetPassword(this.checked)" >
                            <label for="epm-user-rp-cb" style="margin:0 auto;padding: 0;">Reset Password</label>
                    </div>
                    <br />
                    <div id="rpbox-div" style="margin:0; display:none;">
                        <div class="input-group" style="width: 320px;height: 60px;margin: auto;">
                            <span class="input-group-addon" style="height: 60px; width:120px;">Password</span>
                            <input type="password" id="epm-user-pass" name="user[password]" class="form-control" style="height:30px;width:200px;" placeholder="Password" >
                            <input type="password" id="epm-user-confirm" name="user[confirm]" class="form-control" style="height:30px;width:200px;" placeholder="confirm" >
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" style="min-width: 80px;background-color: darkolivegreen; color:white;" class="btn">Modify</button>
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

function openProfile()
{
    var user =  $user;
    $("#epm-user-id").val(user.id);
    $("#epm-user-name").val(user.name);
    $("#epm-user-lastname").val(user.lastname);
    $("#epm-user-nid").val(user.national_id);
    $("#epm-user-da").val(user.default_area);
    $("#epm-user-cp").val("");
    $("#profileModal").modal("show");
}

function validate_ep()
{
    var rp = $("#epm-user-rp-cb").is(":checked");
    if(rp)
        {
            var p = $("#epm-user-pass").val();
            var c = $("#epm-user-confirm").val();
            if(p == "") {alert("Enter your new password."); return false;}
            if(c == "") {alert("Enter password confirmation."); return false;}
            if(p != c) {alert("Password confirmation is not matched."); return false;}
        }
    var cp = $("#epm-user-cp").val();
    var id = $("#epm-user-id").val();
    $.ajax(
        {
        url: "$bPath/main/check_current_password",
        type:"POST",
        data:{'id':id, 'password':cp},
        success: function(ok)
            { 
            if(ok == true)
            return true;
            else {alert("Your current password is not correct."); return false;}
            }
        }
    );
}
function resetPassword(toggle)
{
    if(toggle) $("#rpbox-div").css("display", "block");
    else $("#rpbox-div").css("display", "none");
}

JS;
$this->registerJs($epmJs, Yii\web\View::POS_END);
?>