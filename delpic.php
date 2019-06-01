<?php
session_start();
if (isset($_SESSION['user']) == false) {
    die();
}
$user = $_SESSION['user'];
include("config.php");
if (isset($_POST['pic']) == false) {
    die();
}
$pic = sqlstr($_POST['pic']);
$sql = "select * from `post_pics` where `address`='$pic'";
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) > 0) {
    $fild = mysqli_fetch_assoc($res);
    $post_id = $fild['post_id'];
    $sql = "select * from `post` where `user`='$user' and `id`=$post_id";
    $res = mysqli_query($connect, $sql);
    if (mysqli_num_rows($res) > 0) {
        $sql = "delete from `post_pics` where `address`='$pic'";
        $res = mysqli_query($connect, $sql);
    }
}
?>