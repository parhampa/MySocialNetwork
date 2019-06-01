<?php
include("config.php");
if (isset($_POST['city']) == false) {
    die();
}
$city = sqlint($_POST['city']);
$sql = "select * from `city` where `id`=$city";
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) == 0) {
    setcookie("0", $city, time() + (86400 * 30), "/");
}
setcookie("city", $city, time() + (86400 * 30), "/");
?>