<?php
session_start();
if (isset($_SESSION['user']) == false) {
    die();
}
if ($_SESSION['user'] != "admin") {
    die();
}
include("config.php");
if (isset($_GET['delete']) == true) {
    $cat_id = sqlint($_GET['delete']);
    $sql = "delete from cat where `id`=$cat_id";
    $res = mysqli_query($connect, $sql);
    if ($res) {
        respm("0", "your category is deleted...");
    } else {
        $pmw = "we have a problem in this action...";
        respm("0", $pmw);
    }
    die();
}
$cat_ord = 0;
if (isset($_POST['cat_ord']) == true) {
    $cat_ord = sqlint($_POST['cat_ord']);
}
$father = 0;
if (isset($_POST['father']) == true) {
    $father = sqlint($_POST['father']);
}
if (isset($_POST['title']) == false) {
    respm("0", "please insert category title...");
    die();
}
$title = sqlstr($_POST['title']);
if ($title == "") {
    respm("0", "please insert category title...");
    die();
}
$sql = "insert into cat (`cat_ord`,`father`,`title`) VALUES ($cat_ord,$father,'$title')";
$pmr = "your category is added...";
$pmw = "we have a problem in this action...";
if (isset($_GET['update']) == true) {
    $cat_id = sqlint($_GET['update']);
    $sql = "update cat set `cat_ord`='$cat_ord',`father`='$father',`title`='$title' WHERE id=$cat_id";
    $pmr = "your category is changed...";
}
$res = mysqli_query($connect, $sql);
if ($res) {
    respm("0", $pmr);
} else {
    respm("0", $pmw);
}
?>