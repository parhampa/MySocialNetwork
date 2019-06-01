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
?>
<html>
<head>
    <title><?php echo($webtitle); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/mycss.css">
    <script src="js/jquery.min.js"></script>
    <?php
    if ($admin == true) {
        ?>
        <script src="js/adminjs.js"></script>
        <?php
    }
    ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body class="backload">
<div style="width: 80%; margin-left: 10%;" class="w3-white w3-panel w3-card-2" id="mainpart">
    <span style="font-size: 12px;" class="w3-text-blue">messages <span class="w3-text-red" style="width: 15px;">5</span></span>
    <div style="height: 40px; width: 100%; margin-top: 10px; margin-bottom: 10px;" class="scrollmenu">
        <span class="w3-btn w3-blue w3-hover-pink <?php echo($loginstatus); ?>"
              onclick="addanewpost()" style="border-radius: 25px;">add a new post</span>
        <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;" onclick="showcatlist()">category</span>
        <?php
        if ($loginstatus != "") {
            ?>
            <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;"
                  onclick="location.replace('index.php')">login</span>
            <?php
        } else {
            ?>
            <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;"
                  onclick="location.replace('logout.php')">logout</span>
            <?php
        }
        if ($admin == true) {
            ?>
            <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;"
                  onclick="showaddcat()">add category</span>
            <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;"
                  onclick="document.getElementById('addcitym').style.display='block'">add city</span>
            <?php
        }
        ?>
    </div>
    <div>
        <span onclick="selcitym();">
            <i class="fas fa-map-marker-alt"></i> <span style="color: blue;">
                <?php
                $citycooki = 0;
                if (isset($_COOKIE['city']) == true) {
                    if ($_COOKIE['city'] != 0) {
                        $citycooki = sqlint($_COOKIE['city']);
                    }
                }
                if ($citycooki != 0) {
                    $sqlselcity = "select * from `city` where `id`=$citycooki";
                    $resselcity = mysqli_query($connect, $sqlselcity);
                    if (mysqli_num_rows($resselcity) > 0) {
                        $fildselcity = mysqli_fetch_assoc($resselcity);
                        echo($fildselcity['title']);
                    } else {
                        echo("all cities");
                    }
                } else {
                    echo("all cities");
                }
                ?>

            </span>
        </span>
        <br>
        <br>
        <div id="selcity" class="w3-modal">
            <span class="w3-button w3-red w3-hover-red w3-xlarge w3-display-topright"
                  onclick="document.getElementById('selcity').style.display='none'">&times;</span>
            <div class="w3-modal-content w3-animate-zoom" style="padding: 50px;">
                <?php
                $sqlselcity = "select * from `city` order by `city_ord` DESC";
                $resselcity = mysqli_query($connect, $sqlselcity);
                ?>
                <i class="fas fa-map-marker-alt"></i>
                <select class="w3-select w3-border" style="width: 40%;" id="selcityfilter">
                    <option value="0">all cities</option>
                    <?php
                    while ($fildselcity = mysqli_fetch_assoc($resselcity)) {
                        ?>
                        <option value="<?php echo($fildselcity['id']); ?>"><?php echo($fildselcity['title']); ?></option>
                        <?php
                    }
                    ?>
                </select>
                <span class="w3-btn w3-green" onclick="showcitysel()">set city</span>
            </div>
        </div>
    </div>
    <div id="categorylist" class="w3-modal">
            <span class="w3-button w3-red w3-hover-red w3-xlarge w3-display-topright"
                  onclick="document.getElementById('categorylist').style.display='none'">&times;</span>
        <div class="w3-modal-content w3-animate-zoom" style="padding: 10px;">
            <div id="parrentcats" style="padding-top: 50px ; padding-bottom: 50px;">
                <?php
                $sqlcat = "select * from `cat` where `father`=0 order by `cat_ord` DESC";
                $rescat = mysqli_query($connect, $sqlcat);
                while ($fildcat = mysqli_fetch_assoc($rescat)) {
                    ?>
                    <span class="w3-btn w3-green"
                          onclick="showsubcatlist(<?php echo($fildcat['id']); ?>)"><?php echo($fildcat['title']); ?></span>
                    <?php
                }
                ?>
            </div>
            <div id="subparrentcats" style="padding-top: 50px ; padding-bottom: 50px;">
            </div>
        </div>
    </div>
    <?php
    if ($admin == true) {
        ?>
        <div id="addcitym" class="w3-modal">
            <span class="w3-button w3-red w3-hover-red w3-xlarge w3-display-topright"
                  onclick="document.getElementById('addcitym').style.display='none'">&times;</span>
            <div class="w3-modal-content w3-animate-zoom" style="padding: 10px;">
                <input type="text" id="addcityname" class="w3-input w3-border" placeholder="city name">
                <br>
                <input type="text" id="addcityorder" class="w3-input w3-border" placeholder="city order">
                <br>
                <input onclick="addcityf()" type="button" style="border-radius: 5px; width: 100%;"
                       class="w3-btn w3-green w3-hover-blue" value="add city">
            </div>
        </div>

        <div id="addcat" class="w3-modal">
            <span class="w3-button w3-red w3-hover-red w3-xlarge w3-display-topright"
                  onclick="document.getElementById('addcat').style.display='none'">&times;</span>
            <div class="w3-modal-content w3-animate-zoom" style="padding: 10px;" id="addcatplc">
                <form>
                    <input type="text" class="w3-input w3-border" id="cat_ord"
                           placeholder="your category order: for example 10"><br>
                    <select id="father" class="w3-input w3-border">
                        <option value="0">your category father</option>
                        <?php
                        $sql = "select * from cat where `father`=0 order by `cat_ord` DESC";
                        $res = mysqli_query($connect, $sql);
                        while ($fild = mysqli_fetch_assoc($res)) {
                            ?>
                            <option value="<?php echo($fild['id']); ?>"><?php echo($fild['title']); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <br>
                    <input type="text" class="w3-input w3-border" id="title"
                           placeholder="your category title: for example sport news"><br>
                    <span class="w3-btn w3-blue" onclick="addcat()">add category</span>
                    <span class="w3-btn w3-blue" id="editcat" style="display:none;"
                          onclick="editcat()">edit category</span>
                    <span class="w3-btn w3-blue" id="deletecat" style="display:none;" onclick="deletecat()">delete category</span>
                    <br>
                    <br>
                    <span class="w3-btn w3-blue" id="addselitem" style="display: none;"
                          onclick="showaddselcatpg()">add select item</span>
                    <span class="w3-btn w3-blue" id="addnumericitem" style="display: none;"
                          onclick="showaddnumericplc()">add numeric item</span>
                    <span class="w3-btn w3-blue" id="addstringitem" style="display: none;"
                          onclick="showstringplc()">add string item</span>

                </form>
                <div id="catplc">
                    <?php
                    $sql = "select * from cat where `father`=0 ORDER BY `cat_ord` DESC ";
                    $res = mysqli_query($connect, $sql);
                    while ($fild = mysqli_fetch_assoc($res)) {
                        ?>
                        <br><br><span class="w3-btn w3-pink w3-round-xxlarge"
                                      onclick="docat(<?php echo($fild['id']); ?>,'<?php echo($fild['title']); ?>','<?php echo($fild['father']); ?>',<?php echo($fild['cat_ord']); ?>)"><?php echo($fild['title']); ?></span>
                        <br><br>
                        <?php
                        $father = $fild['id'];
                        $sql2 = "select * from cat where `father`=$father order by `cat_ord` DESC ";
                        $res2 = mysqli_query($connect, $sql2);
                        while ($fild2 = mysqli_fetch_assoc($res2)) {
                            ?>
                            <span class="w3-btn w3-green w3-round-xxlarge"
                                  onclick="docat(<?php echo($fild2['id']); ?>,'<?php echo($fild2['title']); ?>','<?php echo($fild2['father']); ?>',<?php echo($fild2['cat_ord']); ?>)"><?php echo($fild2['title']); ?></span>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="w3-modal-content w3-animate-zoom" style="padding: 10px; display: none;" id="addselcatplc">
                <form>
                    <input type="text" class="w3-input w3-border" id="addselcat_id" placeholder="your category id"
                           disabled>
                    <input type="text" class="w3-input w3-border" id="addseltitle" placeholder="your selectbox title">
                    <input type="text" class="w3-input w3-border" id="addsel_order" placeholder="your selectbox order">
                    <input type="button" class="w3-btn w3-green w3-hover-blue" onclick="addselectitem()"
                           value="add select box">
                    <input type="button" class="w3-btn w3-blue" value="back" onclick="showaddcat();">
                </form>
            </div>
            <div class="w3-modal-content w3-animate-zoom" style="padding: 10px; display: none;" id="addnumericplc">
                <input type="text" class="w3-input w3-border" placeholder="your numeric category id" id="numericcatid"
                       disabled>
                <input type="text" class="w3-input w3-border" placeholder="your numeric title" id="numerictitle">
                <input type="text" class="w3-input w3-border" placeholder="your numeric order" id="numericorderval">
                <label class="w3-text-blue">Forced entry:</label>
                <select id="numericimportant" class="w3-select w3-border">
                    <option value="0">no</option>
                    <option value="1">yes</option>
                </select>
                <label class="w3-text-blue">Is it money ?</label>
                <select id="numericmoney" class="w3-select w3-border">
                    <option value="0">no</option>
                    <option value="1">yes</option>
                </select>
                <br>
                <br>
                <input type="text" class="w3-btn w3-green w3-hover-blue" value="add numeric item"
                       onclick="addnumericitem()">
                <input type="text" class="w3-btn w3-blue" onclick="showaddcat()" value="back">
            </div>
            <div class="w3-modal-content w3-animate-zoom" style="padding: 10px; display: none;" id="addstringplc">
                <input type="text" class="w3-input w3-border" placeholder="your category id" id="addstringcatid"
                       disabled>
                <input type="text" class="w3-input w3-border" placeholder="your string title" id="addstringtitle">
                <input type="text" class="w3-input w3-border" placeholder="your string order" id="addstringorder">
                <label class="w3-text-blue">Forced entry:</label>
                <select id="stringimportant" class="w3-select w3-border">
                    <option value="0">no</option>
                    <option value="1">yes</option>
                </select>
                <label class="w3-text-blue">Is it textarea?</label>
                <select id="stringtextarea" class="w3-select w3-border">
                    <option value="0">no</option>
                    <option value="1">yes</option>
                </select>
                <br>
                <br>
                <input type="button" class="w3-btn w3-green w3-hover-blue" value="add string item"
                       onclick="addstringitem()">
                <input type="button" class="w3-btn w3-blue" value="back" onclick="showaddcat()">
            </div>
        </div>
        <?php
    }
    if (isset($_SESSION['user']) == true) {
        ?>
        <div id="addpost" class="w3-modal">
            <span class="w3-button w3-red w3-hover-red w3-xlarge w3-display-topright"
                  onclick="document.getElementById('addpost').style.display='none'">&times;</span>

            <div class="w3-modal-content w3-animate-zoom" style="padding: 10px;" id="postform1">
                <select class="w3-select w3-border" id="add_fcat" onchange="loadsubcat();">
                    <option value="">select category</option>
                    <?php
                    $sql = "select * from `cat` where father=0 order by `cat_ord` DESC";
                    $res = mysqli_query($connect, $sql);
                    while ($fild = mysqli_fetch_assoc($res)) {
                        ?>
                        <option value="<?php echo($fild['id']); ?>"><?php echo($fild['title']); ?></option>
                        <?php
                    }
                    ?>
                </select>
                <br>
                <br>
                <div id="subcatplace"></div>
                <br><br>
                <div id="morinfo" style="display: none;">
                    <textarea style="width: 100%;" rows="5" maxlength="300"
                              id="addmortxt" placeholder="your more information"></textarea>
                    <br>
                    <br>
                    <select class="w3-select w3-border" id="addreq_type">
                        <option value="0">Provider</option>
                        <option value="1">Applicant</option>
                    </select>
                    <br>
                    <br>
                    <select class="w3-select w3-border" id="addcity">
                        <?php
                        $sql = "select * from `city` order by `city_ord` DESC ";
                        $res = mysqli_query($connect, $sql);
                        while ($fild = mysqli_fetch_assoc($res)) {
                            ?>
                            <option value="<?php echo($fild['id']); ?>"><?php echo($fild['title']); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <br>
                    <input onclick="addpost()" type="button" style="border-radius: 5px; width: 100%;"
                           class="w3-btn w3-green w3-hover-blue" value="next">
                </div>
            </div>
            <div class="w3-modal-content w3-animate-zoom" style="padding: 10px; display: none;" id="postform2">
                <?php
                if ($admin == true) {
                    ?>
                    <input type="text" placeholder="your select id" value="" id="adminselectid"><br>
                    <input type="text" placeholder="your addition title" value="" id="adminadditiontitle"><br>
                    <input type="button" value="add option" onclick="addselectitemfunc()">
                    <?php
                }
                ?>
                <div style="width: 100%;" id="postform2content">

                </div>

            </div>
            <div class="w3-modal-content w3-animate-zoom" style="padding: 10px; display: none;" id="postform3">
                <div style="min-height: 160px; width: 100%; border-style: dashed; border-radius: 5px; background-color: darkgray;">

                </div>
                <br>
                <div class="row">
                    <label for="fileToUpload">Select a File to Upload</label><br/>
                    <input type="file" name="fileToUpload[]" id="fileToUpload" onchange="fileSelected();"
                           accept="image/*" multiple/>
                    <input type="button" class="w3-btn w3-green w3-hover-blue" value="upload picture"
                           onclick="uploadFile(0)">
                    <div class="w3-light-grey w3-round">
                        <div class="w3-container w3-blue w3-round" style="width:0%" id="progressbar">0%</div>
                    </div>
                    <br>
                    <input type="button" class="w3-btn w3-blue w3-hover-red" value="finish" onclick="finishpost();">
                    <div id="progressNumber"></div>

                </div>
            </div>
        </div>
        <?php
        if ($admin == true) {
            ?>
            <div style="width: 100%;">
                <span class="w3-btn w3-green" onclick="location.replace('main.php?all=1')">show all post</span>
                <span class="w3-btn w3-green" onclick="location.replace('main.php?vi=1')">show visible post</span>
                <span class="w3-btn w3-green" onclick="location.replace('main.php?vi=0')">show unvisible post</span>
            </div>
            <?php
        }
    }
    if (isset($_GET['all']) == true) {
        if ($_GET['all'] == 1) {
            $_COOKIE['city'] = "0";
        }
    }
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
                        echo($fildcity['title']);
                        ?></div>
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
                                    class="fas fa-plus"></i> add pic</span>
                        <?php
                        if ($piccount > 0) {
                            ?>
                            <span onclick="delpic(<?php echo($fild['id']); ?>)" class="w3-btn w3-pink w3-round-xxlarge"><i
                                        class="fas fa-minus"></i> delete pic</span>
                            <?php
                        }
                    }
                    ?>

                    <hr>
                    <p><?php echo($fild['txt']); ?></p>
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
</div>
</body>
<script src="js/myjs.js"></script>
</html>