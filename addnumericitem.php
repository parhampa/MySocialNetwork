<?php
session_start();
if (isset($_SESSION['user']) == false) {
    die();
}
if ($_SESSION['user'] != "admin") {
    die();
}
include("config.php");
if (isset($_POST['cat_id']) == false) {
    die();
}
$cat_id = sqlint($_POST['cat_id']);
if (isset($_POST['title']) == false) {
    die();
}
$title = sqlstr($_POST['title']);
if ($title == "") {
    die();
}
if (isset($_POST['orderval']) == false) {
    die();
}
$orderval = sqlint($_POST['orderval']);
if (isset($_POST['important']) == false) {
    die();
}
$important = sqlint($_POST['important']);
if ($important != 0 && $important != 1) {
    die();
}
if (isset($_POST['ismoney']) == false) {
    die();
}
$ismoney = sqlint($_POST['ismoney']);
if ($ismoney != 0 && $ismoney != 1) {
    die();
}

$sql = "insert into `numericval_item` (`title`,`orderval`,`cat_id`,`important`,`ismoney`) VALUE 
      ('$title',$orderval,$cat_id,$important,$ismoney)";
$res = mysqli_query($connect, $sql);
if ($res) {
    respm("1", "your numeric value is in database now...");
} else {
    respm("0", "we have problem to do that!!!");
}
?>