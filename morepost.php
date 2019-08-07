<?php
session_start();
$admin = false;
if (isset($_SESSION['user']) == true) {
    if ($_SESSION['user'] == 'admin') {
        $admin = true;
    }
}

include("config.php");
if (isset($_GET['id']) == false) {
    die();
}
$postid = sqlint($_GET['id']);
$sql = "select * from `post` where `id`=$postid";
$res = mysqli_query($connect, $sql);
$fild = mysqli_fetch_assoc($res);
$cat_id = $fild['cat_id'];
$puser = $fild['user'];
$pcity = $fild['city_id'];
$sqlpu = "select * from `users` where `user`='$puser' and `shop_admin`=1";
$respu = mysqli_query($connect, $sqlpu);
$aduser = "";
if (mysqli_num_rows($respu) == 1) {
    $fildpu = mysqli_fetch_assoc($respu);
    $aduser = $fildpu['mobile'];
} else {
    $sqlpu2 = "select * from `users` where `city_admin`=1 and `city`=$pcity";
    $respu2 = mysqli_query($connect, $sqlpu2);
    if (mysqli_num_rows($respu2) > 0) {
        $fildpu2 = mysqli_fetch_assoc($respu2);
        $aduser = $fildpu2['mobile'];
    } else {
        $sqlpu3 = "select * from `users` where `user`='$puser'";
        $respu3 = mysqli_query($connect, $sqlpu3);
        $fildpu3 = mysqli_fetch_assoc($respu3);
        $aduser = $fildpu3['mobile'];
    }
}
if ($admin == true) {
    $upnumber = "";
    $sqlupn = "select * from `users` where `user`='$puser'";
    $resupn = mysqli_query($connect, $sqlupn);
    $fildupn = mysqli_fetch_assoc($resupn);
    $upnumber = $fildupn['mobile'];
    echo($di_user_phone_number . " : " . $upnumber . "<br>");
}
if (isset($_SESSION['user']) == true) {
    if ($_SESSION['user'] == $puser) {
        $upnumber = "";
        $sqlupn = "select * from `users` where `user`='$puser'";
        $resupn = mysqli_query($connect, $sqlupn);
        $fildupn = mysqli_fetch_assoc($resupn);
        $upnumber = $fildupn['mobile'];
        echo($di_phone_number . " : " . $upnumber . "<br>");
    } else {
        echo($di_phone_number . " : " . $aduser . "<br>");
    }
} else {
    echo($di_phone_number . " : " . $aduser . "<br>");
}
$sql = "select * from `selectbox_item` WHERE `cat_id`=$cat_id order by `sel_order` DESC";
$res = mysqli_query($connect, $sql);
while ($fild = mysqli_fetch_assoc($res)) {
    $selectid = $fild['id'];
    $sql2 = "select * from `post_select` where `post_id`=$postid and `select_id`=$selectid";
    $res2 = mysqli_query($connect, $sql2);
    if (mysqli_num_rows($res2) > 0) {
        $fild2 = mysqli_fetch_assoc($res2);
        $selval = $fild2['selval'];
        $sleid = $fild2['id'];
        $sql2 = "select * from `selectbox_val` where `id` = $selval";
        $res2 = mysqli_query($connect, $sql2);
        $fild2 = mysqli_fetch_assoc($res2);
        echo($fild['title'] . ": <span id='selid" . $sleid . "' onclick='editselitems(" . $sleid . "," . $postid . ");'>" . $fild2['title'] . "</span><br>");
    }
}
$sql = "select * from `stringval_item` where `cat_id`=$cat_id order by `order_string` DESC";
$res = mysqli_query($connect, $sql);
while ($fild = mysqli_fetch_assoc($res)) {
    $stringtitle = $fild['title'];
    $stringid = $fild['id'];
    $sql2 = "select * from `post_string` where `post_id`=$postid and `sid`=$stringid";
    $res2 = mysqli_query($connect, $sql2);
    $fild2 = mysqli_fetch_assoc($res2);
    $stringvalue = $fild2['value'];
    $sid = $fild2['sid'];
    if ($sid != "") {
        $sql3 = "select * from `stringval_item` where `id`=$sid and `bigtext`=1";
        $res3 = mysqli_query($connect, $sql3);
        if (mysqli_num_rows($res3) == 0) {
            echo($stringtitle . ": <span onclick='editmortxt(" . $fild2['id'] . "," . $postid . ")' id='strid" . $fild2['id'] . "'>" . $stringvalue . "</span><br>");
        } else {
            echo($stringtitle . ": <span onclick='editmortxtarea(" . $fild2['id'] . "," . $postid . ")' id='strid" . $fild2['id'] . "'>" . $stringvalue . "</span><br>");
        }
    }
}
$sql = "select * from `numericval_item` where `cat_id`=$cat_id order by `orderval` DESC";
$res = mysqli_query($connect, $sql);
while ($fild = mysqli_fetch_assoc($res)) {
    $numerictitle = $fild['title'];
    $numericid = $fild['id'];
    $sql2 = "select * from `post_numericval` where `post_id`=$postid and `nid`=$numericid";
    $res2 = mysqli_query($connect, $sql2);
    $fild2 = mysqli_fetch_assoc($res2);
    $numericvalue = $fild2['value'];
    $numid = $fild2['id'];
    echo($numerictitle . ": <span onclick='editmornumber(" . $numid . ", " . $postid . ")' id='numid" . $numid . "'>" . $numericvalue . "</span><br>");
}
?>