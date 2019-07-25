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
$fullfilter = "";
if (isset($_GET['filterres']) == true) {
    if (isset($_GET['catid']) == true) {
        $pcatid = sqlint($_GET['catid']);
        $sqlcat = "select * from `cat` where `id`=$pcatid";
        $rescat = mysqli_query($connect, $sqlcat);
        if (mysqli_num_rows($rescat) > 0) {
            $sqlselect = "select `id` from `selectbox_item` where `cat_id`=$pcatid and `filter`=1";
            $resselect = mysqli_query($connect, $sqlselect);
            $selects = "";
            $rows = mysqli_num_rows($resselect);
            while ($fildselect = mysqli_fetch_assoc($resselect)) {
                $selitem = "selectid" . $fildselect['id'];
                if (isset($_GET[$selitem]) == true) {
                    if ($selects != "") {
                        $selects = $selects . "or (`select_id`=" . $fildselect['id'] . " and `selval`=" . sqlint($_GET[$selitem]) . ")";
                    } else {
                        $selects = " (`select_id`=" . $fildselect['id'] . " and `selval`=" . sqlint($_GET[$selitem]) . ")";
                    }
                }
            }
            if ($selects != "") {
                $fullfilter = " `id` in (select concat(`post_id`) from `post_select` where $selects)";
            }
            $sqlstring = "select `id` from `stringval_item` where `cat_id`=$pcatid and `filter`=1";
            $resstring = mysqli_query($connect, $sqlstring);
            $strings = "";
            while ($fildstring = mysqli_fetch_assoc($resstring)) {
                $stritem = "filtertextid" . $fildstring['id'];
                if (isset($_GET[$stritem]) == true) {
                    $strval = sqlstr($_GET[$stritem]);
                    if (trim($strval) != "") {
                        $sid = $fildstring['id'];
                        if ($strings == "") {
                            $strings = "(`sid`=$sid and `value` like '%$strval%')";
                        } else {
                            $strings = $strings . " or (`sid`=$sid and `value` like '%$strval%')";
                        }
                    }
                }
            }
            if ($strings != "") {
                if ($fullfilter == "") {
                    $fullfilter = " `id` in (select concat(`post_id`) from `post_string` where $strings)";
                } else {
                    $fullfilter = $fullfilter . " and `id` in (select concat(`post_id`) from `post_string` where $strings)";
                }
            }
            die($fullfilter);
        }
    }
}
if ($admin == true) {
    $sqlpost = "select * from `post` $filter order by `id` DESC limit 0,15";
} else {
    $sqlpost = "select * from `post` where `visible`=1 $filter order by `post_order` DESC limit 0,15";
}
?>