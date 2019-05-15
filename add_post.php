<?php
session_start();
if (isset($_SESSION['user']) == false) {
    die();
}
$user = $_SESSION['user'];
include("config.php");
if (isset($_POST['txt']) == false) {
    die();
}
$txt = sqlstr($_POST['txt']);
$txt = trim($txt);
if ($txt == "") {
    die();
}
if (isset($_POST['city_id']) == false) {
    die();
}
$city_id = sqlint($_POST['city_id']);
if (isset($_POST['cat_id']) == false) {
    die();
}
$cat_id = sqlint($_POST['cat_id']);
if (isset($_POST['req_type']) == false) {
    die();
}
$req_type = sqlint($_POST['req_type']);
date_default_timezone_set("Asia/Tehran");
putenv("Tz=Asia/Tehran");
$tarikh = date("Y-m-d");
$saat = date("h:i:sa");
$ulike = 0;
$visible = 0;
$sql = "insert into post (`user`,`tarikh`,`saat`,`txt`,`cat_id`,`city_id`,`req_type`,`ulike`,`visible`) VALUES 
                      ('$user','$tarikh','$saat','$txt',$cat_id,$city_id,$req_type,$ulike,$visible)";
$res = mysqli_query($connect, $sql);
if ($res) {
    $last_id = mysqli_insert_id($connect);
    respm("$last_id", "your post is in database now...");
} else {
    respm("0", "some thing is wrong, we can`t do that!!!");
}
?>