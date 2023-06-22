<!-- Modal -->
<div class="modal fade" id="editSiteModal" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:450px;">
        <div class="modal-content">

            <div class="modal-header bg-primary text-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modify Site</h4>
            </div>
            <!--            <form method="post" onsubmit="return editSiteFormvalidate()" action=< ? = Yii::$app->request->baseUrl . "/sitex/edit_site"; ?>>-->
            <div class="modal-body">
                <!-- body -->
                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                <input type="hidden" id="editSiteId" name="exch[id]" value="-1" />
                <input type="hidden" id="editSiteCurrentUplink" name="exch[cupid]" value="-1" />

                <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                    <span class="input-group-addon" style="height: 50px; width:120px;">Mother</span>
                    <input type="text" id="editSiteMother" name="exch[mother]" class="form-control" style="height:50px;width:200px;"  value="" required readonly>
                </div>

                <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                    <span class="input-group-addon" style="height: 50px; width:120px;">Cascade</span>
                    <input type="text" id="editSiteCascade" name="exch[site_cascade]" class="form-control" style="height:50px;width:200px;"  value="" required readonly>
                </div>

                <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                    <span class="input-group-addon" style="height: 50px; width:120px;">Node</span>
                    <input type="text" id="editSiteNode" name="exch[site_node]" class="form-control" style="height:50px;width:200px;"  value="" required>
                </div>

                <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                    <span class="input-group-addon" style="height: 50px; width:120px;">Name</span>
                    <input type="text" id="editSiteNameId"  name="exch[name]" class="form-control" style="height:50px;width:200px;" required>
                </div>

                <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                    <span class="input-group-addon" style="height: 50px; width:120px;">Abbr</span>
                    <input type="text" id="editSiteAbbrId" name="exch[abbr]" class="form-control" style="height:50px;width:200px;" required>
                </div>

                <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                    <span class="input-group-addon" style="height: 50px; width:120px;">Uplink</span>
                    <select id="editSiteUplinkId" name="exch[uplink_id]" class="form-control" style="height:50px;width:200px;">
                    </select>
                </div>

                <div class="input-group" style="max-width: 400px; min-width: 100px;height: 50px;margin: auto;">
                    <span class="input-group-addon" style="height: 50px; width:120px;">Address</span>
                    <textarea name="exch[address]" id="editSiteAddressId" class="form-control" style="width:200px;" rows="3" ></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button style="min-width: 80px;" onclick="modalEditSite()" class="btn btn-primary pull-right">Modify</button>
                <button style="min-width: 80px;" onclick="removeSite()" class="btn btn-danger pull-left">Remove</button>
            </div>
            <!--            </form>-->
        </div>
    </div>
</div>
<!-- Modal -->
<?php
$bPath = Yii::$app->request->baseUrl;
$exchId = $session['exchange']['id'];
$js = <<< JS

function modalEditSite()
{
    if(editSiteFormvalidate())
    {
            var siteId = $("#editSiteId").val();
            var cascade = $("#editSiteCascade").val();
            var node = $("#editSiteNode").val();
            var name = $("#editSiteNameId").val();
            var abbr = $("#editSiteAbbrId").val();
            var uplink = $("#editSiteUplinkId").val();
            var oldUplink = $("#editSiteCurrentUplink").val();
            var address = $("#editSiteAddressId").val();
        
            $.ajax(
                {
                url: "$bPath/sitex/edit_site",
                type:"POST",
                data:{'id':siteId, 'site_node':node, 'name':name, 'abbr':abbr, 'uplink_id':uplink, 'address':address},
        
                success: function(jsn)
                    {
                        jsn = JSON.parse(jsn);
                        console.log(jsn);
                        if(jsn['res'] == true)
                        {
                            var jx2 = parseInt(jsn['x2']);
                            var jy2 = parseInt(jsn['y2']);
                            //update site FE
                            $("#site-"+siteId).attr('title', address);
                            $("#site-"+siteId+" .node-class").html("Node:"+node);
                            $("#site-"+siteId+" .siteName").html(name);
                            $("#site-"+siteId+" .siteAbbr").html(abbr);
                            if(uplink != oldUplink)
                                {
                                    //update uplink link
                                    var objects = $("#site-cascade"+cascade+" svg[sid="+siteId+"]");
                                    var i = 0;
                                    for(i=0; i<objects.length; i++)
                                        {
                                            var item = objects[i];
                                            var line = $(item).find(".line");
                                            var x2 = jx2;
                                            var y2 = jy2;
                                            if(uplink == $exchId)
                                            {
                                                x2 = 0;
                                                y2 = $(line).attr("y1");
                                            }
                                            var w = $(item).attr("width");
                                            var h = $(item).attr("height");
                                            if(w < x2) w = x2;
                                            if(h < y2) h = y2;   
                                            w = w + 150;
                                            h = h + 200;
                                            $(item).attr("upid",uplink);
                                            $(item).attr("width",w);
                                            $(item).attr("height", h);
                                            $(line).attr("x2",x2);
                                            $(line).attr("y2",y2);
                                            $(item).find(".node-uplink").attr("cx", x2);
                                            $(item).find(".node-uplink").attr("cy", y2);  
                                        }
                                }
                            
                            //update edit button attr
                            $("#site-"+siteId +" .sitebox-header .site-move-edit").attr("site-name",name );
                            $("#site-"+siteId +" .sitebox-header .site-move-edit").attr("site-abbr",abbr );
                            $("#site-"+siteId +" .sitebox-header .site-move-edit").attr("site-uplink",uplink );
                            $("#site-"+siteId +" .sitebox-header .site-move-edit").attr("site-node",node );
                            $("#site-"+siteId +" .sitebox-header .site-move-edit").attr("site-address",address );
                            
                            $("#editSiteModal").modal('hide');
                        }
                        else
                            alert("Something went wrong. Check Node number and site abbr.");
                        }
                }
            );
    }    
}

function removeSite()
{
    var siteId = $("#editSiteId").val();
    var name = $("#editSiteNameId").val();
    var cascade = $("#editSiteCascade").val();
    var ret = confirm("Do you want to remove the site named "+name+"?");
    if(ret == true)
        {
            $.ajax(
                {
                url: "$bPath/sitex/remove_site",
                type:"POST",
                data:{'id':siteId},
        
                success: function(ok)
                    {
                        if(ok == true)
                            {
                                //remove site
                                $("#site-"+siteId).css('display', 'none');
                                $("#site-cascade"+cascade+" svg[sid="+siteId+"]").css('display', 'none');
                                $("#editSiteModal").modal('hide');
                            }
                        else
                            {
                                alert("Error! cannot remove the site. The site must be empty and without downlinks.");
                            }
                    }
                }
            );
            
        }
}

function editSiteFormvalidate()
{
    var node = $("#editSiteNode").val();
    var mother = $("#editSiteMotherId").val();
    var uplink = $("#editSiteUplinkId").val();
    if(isNaN(node))
        {
            alert("Node value must be a number.");
            return false;
        }
    if(mother == uplink)
        {
            if(node != 1)
                {
                    alert("First node of the cascade must be the node valued number 1.");
                    return false;
                }
        }
    
    return true;
}



JS;
$this->registerJs($js, Yii\web\View::POS_END);
?>