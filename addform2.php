<?php
session_start();
if (isset($_SESSION['user']) == false) {
    die();
}
$user = $_SESSION['user'];
include("config.php");
if (isset($_GET['id']) == false) {
    die();
}
$id = sqlint($_GET['id']);
if (isset($_GET['cat_id']) == false) {
    die();
}
$sql = "select * from `post` where `id`=$id and `user`='$user'";
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) == 0) {
    die();
}
$cat_id = sqlint($_GET['cat_id']);
$sql = "select * from `selectbox_item` where `cat_id`=$cat_id";
$res = mysqli_query($connect, $sql);
while ($fild = mysqli_fetch_assoc($res)) {
    $select_id = $fild['id'];
    $method = 'addselval' . $select_id;
    if (isset($_POST[$method]) == false) {
        die();
    }
    $selval = $_POST[$method];
    $selval = sqlint($selval);
    $sql2 = "insert into `post_select` (`post_id`,`select_id`,`selval`) VALUES ($id,$select_id,$selval)";
    $res2 = mysqli_query($connect, $sql2);
}
$sql = "select * from `numericval_item` where `cat_id`=$cat_id";
$res = mysqli_query($connect, $sql);
while ($fild = mysqli_fetch_assoc($res)) {
    $nid = $fild['id'];
    $method = "addnumericval" . $nid;
    if (isset($_POST[$method]) == false) {
        $value = 0;
    } elseif ($_POST[$method] == "") {
        $value = 0;
    } else {
        $value = sqlint($_POST[$method]);
    }
    $sql2 = "insert into `post_numericval` (`post_id`,`nid`,`value`) VALUES ($id,$nid,$value)";
    $res2 = mysqli_query($connect, $sql2);
}
$sql = "select * from `stringval_item` where `cat_id`=$cat_id";
$res = mysqli_query($connect, $sql);
while ($fild = mysqli_fetch_assoc($res)) {
    $sid = $fild['id'];
    $method = "addstringval" . $sid;
    if (isset($_POST[$method]) == false) {
        $value = "null";
    } elseif ($_POST[$method] == "") {
        $value = "null";
    } else {
        $value = sqlstr($_POST[$method]);
    }
    $sql2 = "insert into post_string (`post_id`,`sid`,`value`) VALUES ($id,$sid,'$value')";
    $res2 = mysqli_query($connect, $sql2);
}
respm("1", $di_add_form2_pm1);
?>