<?php
session_start();
if (isset($_SESSION['user']) == false) {
    die();
}
if ($_SESSION['user'] != "admin") {
    die();
}
include("config.php");
if (isset($_POST['title']) == false) {
    die();
}
if ($_POST['title'] == "") {
    die();
}
$title = sqlstr($_POST['title']);
if (isset($_POST['city_ord']) == false) {
    die();
}
$city_ord = sqlint($_POST['city_ord']);
$sql = "insert into `city` (`city_ord`,`title`) VALUES ($city_ord,'$title')";
$res = mysqli_query($connect, $sql);
if ($res) {
    respm("1", "your city is in database now...");
} else {
    respm("0", "we can`t add this city...");
}
?>