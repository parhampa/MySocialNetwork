<?php
session_start();
if (isset($_SESSION['user']) == false) {
    die();
}
$user = $_SESSION['user'];
include("config.php");
if (isset($_POST['id']) == false) {
    die();
}
$id = sqlint($_POST['id']);
$sql = "select * from `post` where `id`=$id and `user`='$user'";
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) > 0) {
    if (isset($_POST['city']) == false) {
        die();
    }
    $city = sqlint($_POST['city']);
    $sql = "update `post` set `city_id`=$city where `id`=$id and `user`='$user'";
    $res = mysqli_query($connect, $sql);
}
?>