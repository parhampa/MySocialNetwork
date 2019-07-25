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
if (isset($_POST['txt']) == false) {
    die();
}
$sql = "select * from `post` where `id`=$id and `user`='$user'";
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) > 0) {
    $txt = sqlstr($_POST['txt']);
    if (trim($txt) == "") {
        die();
    }
    $sql = "update `post` set `txt`='$txt' where `id`=$id and `user`='$user'";
    $res = mysqli_query($connect, $sql);
} else {
    die();
}
?>