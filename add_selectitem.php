<?php
session_start();
if (isset($_SESSION['user']) == false) {
    die();
}
if ($_SESSION['user'] != "admin") {
    die();
}
include("config.php");
if (isset($_POST['sid']) == false) {
    die();
}
$sid = sqlint($_POST['sid']);
if (isset($_POST['title']) == false) {
    die();
}
$title = sqlstr($_POST['title']);
if ($title == "") {
    die();
}
$sql = "insert into `selectbox_val` (`sid`,`title`) VALUE ($sid,'$title')";
$res = mysqli_query($connect, $sql);
if ($res) {
    respm("1", "your item value is in database now...");
} else {
    respm("0", "there is a problem with this action!!!");
}
?>