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
if (isset($_POST['title']) == false) {
    die();
}
$title = sqlstr($_POST['title']);
if ($title == "") {
    die();
}
if (isset($_POST['order_string']) == false) {
    die();
}
$order_string = sqlint($_POST['order_string']);
if (isset($_POST['stringimportant']) == false) {
    die();
}
$important = sqlint($_POST['stringimportant']);
if ($important != 0 && $important != 1) {
    die();
}
if (isset($_POST['bigtext']) == false) {
    die();
}
$bigtext = sqlint($_POST['bigtext']);
if ($bigtext != 0 && $bigtext != 1) {
    die();
}
$sql = "insert into `stringval_item` (`cat_id`,`title`,`order_string`,`important`,`bigtext`) values
        ($cat_id,'$title',$order_string,$important,$bigtext)";
$res = mysqli_query($connect, $sql);
if ($res) {
    respm("1", $di_addstringitem_pm1);
} else {
    respm("0", $di_addstringitem_pm2);
}
?>