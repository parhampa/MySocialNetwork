<?php
session_start();
if (isset($_SESSION['user']) == false) {
    die();
}
if ($_SESSION['user'] != "admin") {
    die();
}
include("../config.php");
if (isset($_POST['user']) == false) {
    die();
}
$user = sqlstr($_POST['user']);
if (isset($_POST['ty']) == false) {
    die();
}
$ty = sqlint($_POST['ty']);
if ($ty != 0 && $ty != 1) {
    die();
}
$sql = "select * from `users` where `user`='$user'";
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) == 0) {
    die();
}
$sql = "update `users` set `shop_admin`=$ty WHERE `user`='$user'";
$res = mysqli_query($connect, $sql);
?>