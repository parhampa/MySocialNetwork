<?php
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
$nexturl = "";
function nexturlf($url, $param_name, $param_val)
{
    $urlnew = "";
    if ($url != "") {
        $urlnew = $url . "&" . $param_name . "=" . $param_val;
    } else {
        $urlnew = $param_name . "=" . $param_val;
    }
    return $urlnew;
}

if (isset($_GET['vi']) == true) {
    $vi = sqlint($_GET['vi']);
    $nexturl = nexturlf($nexturl, "vi", $vi);
}

if (isset($_GET['scat']) == true) {
    $scat = sqlint($_GET['scat']);
    $nexturl = nexturlf($nexturl, "scat", $scat);
}
if (isset($_GET['filterres']) == true) {
    $filterres = sqlint($_GET['filterres']);
    $nexturl = nexturlf($nexturl, "filterres", $filterres);
    if (isset($_GET['catid']) == true) {
        $catid = sqlint($_GET['catid']);
        $nexturl = nexturlf($nexturl, "catid", $catid);
        $sqlnumitems = "select * from `numericval_item` where `cat_id`=$catid and `filter`=1";
        $resnumitems = mysqli_query($connect, $sqlnumitems);
        while ($fildnumitems = mysqli_fetch_assoc($resnumitems)) {
            $numberitem1 = "filternumber1id" . $fildnumitems['id'];
            $numberitem2 = "filternumber2id" . $fildnumitems['id'];
            if (isset($_GET[$numberitem1]) == true && isset($_GET[$numberitem2]) == true) {
                $numberval1 = sqlint($_GET[$numberitem1]);
                $numberval2 = sqlint($_GET[$numberitem2]);
                $nexturl = nexturlf($nexturl, $numberitem1, $numberval1);
                $nexturl = nexturlf($nexturl, $numberitem2, $numberval2);
            }
        }
        $sqltxtitemes = "select * from `stringval_item` where `cat_id`=$catid and `filter`=1";
        $restxtitems = mysqli_query($connect, $sqltxtitemes);
        while ($fildtxtitems = mysqli_fetch_assoc($restxtitems)) {
            $txtitem = "filtertextid" . $fildtxtitems['id'];
            if (isset($_GET[$txtitem]) == true) {
                $txtval = sqlstr($_GET[$txtitem]);
                $nexturl = nexturlf($nexturl, $txtitem, $txtval);
            }
        }
        $sqlselitems = "select * from `selectbox_item` where `cat_id`=$catid and `filter`=1";
        $resselitems = mysqli_query($connect, $sqlselitems);
        while ($fildselitems = mysqli_fetch_assoc($resselitems)) {
            $selitem = "selectid" . $fildselitems['id'];
            if (isset($_GET[$selitem]) == true) {
                $selval = sqlint($_GET[$selitem]);
                $nexturl = nexturlf($nexturl, $selitem, $selval);
            }
        }

    }
}
?>
<div id="moreposts"></div>
<div style="width: 60%; margin-left: 20%;">
    <span id="morebtn" style="width: 100%;" class="w3-btn w3-green"
          onclick="loadnext('<?php echo($nexturl); ?>',1);"> <?php echo($di_show_more_posts); ?></span>
    <br>
    <br>
</div>