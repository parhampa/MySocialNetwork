<?php
session_start();
if (isset($_SESSION['user']) == false) {
    die();
}
if ($_SESSION['user'] != "admin") {
    die();
}
include("config.php");
if (isset($_POST['cat_id']) == false) {
    die();
}
$cat_id = sqlint($_POST['cat_id']);
$sql = "select * from `cat` where `id`=$cat_id";
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) == 0) {
    die();
}
if (isset($_POST['title']) == false) {
    die();
}
$title = sqlstr($_POST['title']);
if ($title == "") {
    die();
}
if (isset($_POST['sel_order']) == false) {
    die();
}
$sel_order = sqlint($_POST['sel_order']);
$sql = "insert into `selectbox_item` (`cat_id`,`title`,`sel_order`) VALUES 
          ($cat_id,'$title',$sel_order)";
$res = mysqli_query($connect, $sql);
if ($res) {
    respm("1", "your selectbox is in database now...");
} else {
    respm("0", "we have problem to do that!!!");
}
?>


