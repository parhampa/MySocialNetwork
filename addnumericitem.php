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
$sql = "insert into `numericval_item` (`title`,`orderval`,`cat_id`,`important`) VALUE 
      ('$title',$orderval,$cat_id,$important)";
$res = mysqli_query($connect, $sql);
if ($res) {
    respm("1", "your numeric value is in database now...");
} else {
    respm("0", "we have problem to do that!!!");
}
?>