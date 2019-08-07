<?php
session_start();
$loginstatus = "";
$user = "";
if (isset($_SESSION['user']) == false) {
    $loginstatus = "w3-disabled";
} else {
    $user = $_SESSION['user'];
}
$admin = false;
if (isset($_SESSION['user']) == true) {
    if ($_SESSION['user'] == 'admin') {
        $admin = true;
    }
}
include("config.php");
$pg = 1;
if (isset($_GET['pg']) == false) {
    die();
}
$pg = sqlint($_GET['pg']);
if ($pg < 1) {
    die();
}
$pg = $pg * 15;

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
            $sqlnumeric = "select `id` from `numericval_item` where `cat_id`=$pcatid and `filter`=1";
            $resnumeric = mysqli_query($connect, $sqlnumeric);
            $numberfilter = "";
            while ($fildnumerci = mysqli_fetch_assoc($resnumeric)) {
                $numberitem1 = "filternumber1id" . $fildnumerci['id'];
                $numberitem2 = "filternumber2id" . $fildnumerci['id'];
                if (isset($_GET[$numberitem1]) == true && isset($_GET[$numberitem2]) == true) {
                    $numberval1 = sqlint($_GET[$numberitem1]);
                    $numberval2 = sqlint($_GET[$numberitem2]);
                    if ($numberfilter == "") {
                        $nid = $fildnumerci['id'];
                        $numberfilter = "(`nid`=$nid and (`value` BETWEEN $numberval1 and $numberval2))";
                    } else {
                        $numberfilter = $numberfilter . " and (`nid`=$nid and (`value` BETWEEN $numberval1 and $numberval2))";
                    }
                }
            }
            if ($numberfilter != "") {
                $numberfilter = "select concat(`post_id`) from `post_numericval` where $numberfilter";
                $fullfilter = $fullfilter . "and `id` in ($numberfilter)";
                if ($fullfilter == "") {
                    $fullfilter = " `id` in ($numberfilter)";
                } else {
                    $fullfilter = $fullfilter . " and `id` in ($numberfilter)";
                }
            }
        }
    }
}
if ($admin == true) {
    if ($filter != "" && $fullfilter != "") {
        $fullfilter = " and $fullfilter";
    } elseif ($fullfilter != "" && $filter == "") {
        $fullfilter = " where $fullfilter";
    }
    $sqlpost = "select * from `post` $filter $fullfilter order by `id` DESC limit $pg,15";
} else {
    if ($filter == "" && $fullfilter != "") {
        $fullfilter = " and $fullfilter";
    }
    $sqlpost = "select * from `post` where `visible`=1 $filter $fullfilter order by `post_order` DESC limit $pg,15";
}
$res = mysqli_query($connect, $sqlpost);
while ($fild = mysqli_fetch_assoc($res)) {
    ?>
    <div style="width: 100%; padding: 10px;" class="postmain">
        <div style="width: 70%; margin-left: 15%; padding: 10px;" class="w3-card-2 postcontent">
            <div>
                <div style=" margin-right:10px; float: left ; border-radius: 50%; background-color: black; height: 50px; width: 50px;"></div>
                <div><span style="font-size: 6px;"><br></span><?php echo($fild['user']); ?></div>
                <div style="font-size: 12px; color:blue ;"><?php
                    $city_id = $fild['city_id'];
                    $sqlcity = "select * from `city` where `id`=$city_id";
                    $rescity = mysqli_query($connect, $sqlcity);
                    $fildcity = mysqli_fetch_assoc($rescity);
                    ?>
                    <span id="postcity<?php echo($fild['id']); ?>"
                          onclick="changecity(<?php echo($fild['id']); ?>)"><?php echo($fildcity['title']); ?></span>
                    <span id="selpostcity<?php echo($fild['id']); ?>"></span>
                </div>
                <hr>
            </div>
            <div>
                <div>
                    <?php
                    $post_id = $fild['id'];
                    $sqlpic = "select * from `post_pics` where `post_id`=$post_id";
                    $respic = mysqli_query($connect, $sqlpic);
                    $picaddress = "pic/no_pic.jpg";
                    if (mysqli_num_rows($respic) == 0) {
                        ?>
                        <img src="<?php echo($picaddress); ?>" style="width: 100%;"><br>
                        <?php
                    }
                    $piccount = 0;
                    ?>
                    <?php
                    while ($fildpic = mysqli_fetch_assoc($respic)) {
                        $displaypic = "";
                        if ($piccount > 0) {
                            $displaypic = " display:none;";
                        }
                        if (file_exists($fildpic['address']) == true) {
                            $picaddress = $fildpic['address'];
                        }
                        ?>
                        <img src="<?php echo($picaddress); ?>"
                             style="width: 100%;<?php echo($displaypic); ?>"
                             class="imagepost<?php echo($post_id); ?> imagepostnumber<?php echo($post_id . '-' . $piccount); ?>">
                        <?php
                        $piccount++;
                    }
                    ?>
                    <div id="slidebtn" style="margin-top:5px; width: 100%;">
                        <?php
                        for ($i = 0; $i < mysqli_num_rows($respic); $i++) {
                            ?>
                            <span onclick="showslide(<?php echo($i); ?>,<?php echo($post_id); ?>)" class="w3-gray"
                                  style=" margin-right:10px; float: left ; border-radius: 50%; background-color: black; height: 10px; width: 10px;"></span>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <br>
                <span class="heart"></span>
                <?php
                if ($admin == true) {
                    if ($fild['visible'] == 0) {
                        ?>
                        <span onclick="visiblepost(<?php echo($fild['id']); ?>)"
                              id="visiblepost<?php echo($fild['id']); ?>"><i class="fas fa-eye"></i></span>
                        <span onclick="unvisiblepost(<?php echo($fild['id']); ?>);"
                              id="unvisiblepost<?php echo($fild['id']); ?>"
                              style="display: none;"><i class="fas fa-eye-slash"></i></span>
                        <?php
                    } else {
                        ?>
                        <span onclick="unvisiblepost(<?php echo($fild['id']); ?>);"
                              id="unvisiblepost<?php echo($fild['id']); ?>"><i class="fas fa-eye-slash"></i></span>
                        <span onclick="visiblepost(<?php echo($fild['id']); ?>)"
                              id="visiblepost<?php echo($fild['id']); ?>"
                              style="display: none;"><i class="fas fa-eye"></i></span>
                        <?php
                    }
                }

                if ($fild['user'] == $user) {
                    ?>
                    <br>
                    <br>
                    <span onclick="upmorpic(<?php echo($fild['id']); ?>)"
                          class="w3-btn w3-green w3-round-xxlarge"><i
                                class="fas fa-plus"></i> <?php echo($di_add_pic); ?></span>
                    <?php
                    if ($piccount > 0) {
                        ?>
                        <span onclick="delpic(<?php echo($fild['id']); ?>)" class="w3-btn w3-pink w3-round-xxlarge"><i
                                    class="fas fa-minus"></i> <?php echo($di_delete_pic); ?></span>
                        <?php
                    }
                }
                ?>

                <hr>
                <p id="posttxtid<?php echo($fild['id']); ?>"
                   onclick="edittxt(<?php echo($fild['id']); ?>)"><?php echo($fild['txt']); ?></p>
                <div style="display: none;" id="morpostid<?php echo($fild['id']); ?>"></div>
                <div style="width: 100%; font-size: 12px; color: #979797;">
                        <span onclick="showmorepost(<?php echo($fild['id']); ?>)"
                              id="btnshmor<?php echo($fild['id']); ?>">more...</span>
                    <span style="display: none;" onclick="hidemorepost(<?php echo($fild['id']); ?>)"
                          id="btnhimor<?php echo($fild['id']); ?>">hide...</span>
                </div>

            </div>
        </div>
    </div>
    <br>
    <?php
}
?>