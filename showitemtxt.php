<?php
session_start();
if (isset($_SESSION['user']) == false) {
    die();
}
$user = $_SESSION['user'];
include("config.php");
if (isset($_GET['id']) == false) {
    die();
}
$id = sqlint($_GET['id']);
if (isset($_GET['t']) == true) {
    $sql = "select * from `post_string` where id=$id";
    $res = mysqli_query($connect, $sql);
    if (mysqli_num_rows($res) == 1) {
        $fild = mysqli_fetch_assoc($res);
        $value = $fild['value'];
        $post_id = $fild['post_id'];
        $sql2 = "select * from `post` where `id`=$post_id";
        $res2 = mysqli_query($connect, $sql2);
        $fild2 = mysqli_fetch_assoc($res2);
        if ($fild2['user'] == $user) {
            echo($value);
        }
    }
}
?>