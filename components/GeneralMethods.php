<?php
namespace app\components;

class GeneralMethods
{
    public static function create_device_name($area,$abbr,$row,$column,$shelf,$device,$purchase="",$lio="",$ls="")
    {
        $ret = $area."-".$abbr.'- '.$row.'-'.$column.'-'.$shelf.'- '.$device;

        if( ($purchase != "") && ($lio != "") && ($ls != "") )
            $ret = $ret.'- '.$purchase.'-'.$lio.'-'.$ls;

        return $ret;
    }




}
?>
