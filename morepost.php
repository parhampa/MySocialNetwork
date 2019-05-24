<?php
include("config.php");
if (isset($_GET['id']) == false) {
    die();
}
$postid = sqlint($_GET['id']);
$sql = "select * from `post` where `id`=$postid";
$res = mysqli_query($connect, $sql);
$fild = mysqli_fetch_assoc($res);
$cat_id = $fild['cat_id'];
$sql = "select * from `selectbox_item` WHERE `cat_id`=$cat_id order by `sel_order` DESC";
$res = mysqli_query($connect, $sql);
while ($fild = mysqli_fetch_assoc($res)) {
    $selectid = $fild['id'];
    $sql2 = "select * from `post_select` where `post_id`=$postid and `select_id`=$selectid";
    //echo($sql2);
    $res2 = mysqli_query($connect, $sql2);
    if (mysqli_num_rows($res2) > 0) {
        $fild2 = mysqli_fetch_assoc($res2);
        $selval = $fild2['selval'];
        $sql2 = "select * from `selectbox_val` where `id` = $selval";
        $res2 = mysqli_query($connect, $sql2);
        $fild2 = mysqli_fetch_assoc($res2);
        echo($fild['title'] . ": " . $fild2['title'] . "<br>");
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
    echo($stringtitle . ": " . $stringvalue . "<br>");
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
    echo($numerictitle . ": " . $numericvalue . "<br>");
}
?>