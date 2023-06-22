<div style="width: 504px; margin:auto; height:800px; background-color:#f8f8f8; position: relative; border:2px solid darkslategray;">
    <div class='device-header' style="height: 20px; width:100%; position: absolute; top:0px; background-color: darkslategray"></div>
    <?php
    foreach ($dcp as $obj)
    {
        if($obj['dcp_type'] == 'TITLE')
        {?>
            <div style='background-color:lightgray; color:black;border:1px solid gray; position: absolute; top:<?= $obj['dcp_top'].'px'; ?>; left:<?= $obj['dcp_left'].'px'; ?>; width: <?= $obj["dcp_width"].'px'; ?>; height:<?= $obj["dcp_height"].'px'; ?>;text-align: center; vertical-align: middle; line-height: <?= $obj['dcp_height'].'px'; ?>; '><?= $device['type']." ".$device['device']; ?></div>
        <?php
        }
        else if($obj['dcp_type'] == 'FAN')
        {?>
            <div style='background-color:#cee3f1; color:#2b81af;border:1px solid dodgerblue; position: absolute; top:<?= $obj['dcp_top'].'px'; ?>; left:<?= $obj['dcp_left'].'px'; ?>; width: <?= $obj["dcp_width"].'px'; ?>; height:<?= $obj["dcp_height"].'px'; ?>;text-align: center; vertical-align: middle; line-height: <?= $obj['dcp_height'].'px'; ?>; '>F A N</div>
            <?php
        }
        else if($obj['dcp_type'] == 'OBJECT')
        {

        }
        else if($obj['dcp_type'] == 'CONTROL')
        {

        }
        else if($obj['dcp_type'] == 'BACK')
        {?>
            <div style='background-color:#8699a4; color:black;border:1px solid black; position: absolute; top:<?= $obj['dcp_top'].'px'; ?>; left:<?= $obj['dcp_left'].'px'; ?>; width: <?= $obj["dcp_width"].'px'; ?>; height:<?= $obj["dcp_height"].'px'; ?>;text-align: center; vertical-align: middle; line-height: <?= $obj['dcp_height'].'px'; ?>; '></div>
            <?php
        }
        else if($obj['dcp_type'] == 'LINE')
        {

        }
        else if($obj['dcp_type'] == 'POWER')
        {

        }
    }
    ?>

    <div style="height:200px; width: 500px;"></div>
    <div class='device-footer' style="height: 20px; width:100%; position: absolute; bottom:0px; background-color:darkslategray;"></div>
</div>
