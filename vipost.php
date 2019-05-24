<?php
session_start();
if (isset($_SESSION['user']) == false) {
    die();
}
if ($_SESSION['user'] != "admin") {
    die();
}
include("config.php");
if (isset($_GET['id']) == false) {
    die();
}
$id = sqlint($_GET['id']);
if (isset($_GET['vi']) == false) {
    die();
}
$vi = sqlint($_GET['vi']);
if ($vi != 0 && $vi != 1) {
    die();
}
$sql = "update `post` set `visible`=$vi where id=$id";
$res = mysqli_query($connect, $sql);
?>