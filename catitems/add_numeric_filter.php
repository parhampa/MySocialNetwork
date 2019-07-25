<?php
session_start();
if (isset($_SESSION['user']) == false) {
    die();
}
if ($_SESSION['user'] != "admin") {
    die();
}
include("../config.php");
if (isset($_POST['id']) == false) {
    die();
}
$id = sqlint($_POST['id']);
$sql = "select * from `numericval_item` where `id`=$id";
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) == 0) {
    die();
}
if (isset($_POST['ty']) == false) {
    die();
}
$ty = sqlint($_POST['ty']);
if ($ty != 0 && $ty != 1) {
    die();
}
$sql = "update `numericval_item` set `filter`=0 where `id`=$id";
if ($ty == 1) {
    $sql = "update `numericval_item` set `filter`=1 where `id`=$id";
}
$res = mysqli_query($connect, $sql);
?>