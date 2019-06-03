<?php
$filter = "";
if ($admin == true) {
    if (isset($_GET['vi']) == true && $admin == true) {
        $vi = sqlint($_GET['vi']);
        if ($vi != 0 && $vi != 1) {
            die();
        }
        if ($filter == "") {
            $filter = " where `visible`=$vi";
        } else {
            $filter = "`visible`=$vi";
        }
    }
}
$sqlpost = "";
if (isset($_GET['scat']) == true) {
    $scat = sqlint($_GET['scat']);
    $scatf = "`cat_id`=$scat";
    if ($admin == true) {
        if ($filter == "") {
            $filter = " where $scatf";
        } else {
            $filter = " and $scatf";
        }
    } else {
        $filter = " and $scatf";
    }
}
include("addfilter.php");
$filter = add_cooki_number_filter('city', $admin, $filter, "city_id", true);
if ($admin == true) {
    $sqlpost = "select * from `post` $filter order by `id` DESC limit 0,15";
} else {
    $sqlpost = "select * from `post` where `visible`=1 $filter order by `post_order` DESC limit 0,15";
}
?>