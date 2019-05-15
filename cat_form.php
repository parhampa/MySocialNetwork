<?php
session_start();
if (isset($_SESSION['user']) == false) {
    die();
}
include("config.php");
if (isset($_POST['cat_id']) == false) {
    die();
}
$cat_id = sqlint($_POST['cat_id']);
?>{"items":[<?php
$sql = "select * from `selectbox_item` where `cat_id`=$cat_id order by `sel_order` DESC";
$res = mysqli_query($connect, $sql);
$count = 0;
while ($fild = mysqli_fetch_assoc($res)) {
    if ($count > 0) {
        echo(",");
    }
    ?>{"id":"<?php echo($fild['id']); ?>","title":"<?php echo($fild['title']); ?>","order":"<?php echo($fild['sel_order']); ?>","type":"select","vals":[<?php
    $sid = $fild['id'];
    $sql2 = "select * from `selectbox_val` where `sid`=$sid";
    $res2 = mysqli_query($connect, $sql2);
    $counton = 0;
    while ($fild2 = mysqli_fetch_assoc($res2)) {
        if ($counton > 0) {
            echo(",");
        }
        ?>{"optid":"<?php echo($fild2['id']); ?>","opttitle":"<?php echo($fild2['title']); ?>"}<?php
        $counton++;
    }
    ?>]}<?php
    $count++;
}
$sql = "select * from `numericval_item` where `cat_id`=$cat_id order by `orderval` DESC";
$res = mysqli_query($connect, $sql);
while ($fild = mysqli_fetch_assoc($res)) {
    if ($count > 0) {
        echo(",");
    }
    ?>{"id":"<?php echo($fild['id']); ?>","title":"<?php echo($fild['title']); ?>","order":"<?php echo($fild['orderval']); ?>","type":"numeric","important":"<?php echo($fild['important']); ?>"}<?php
    $count++;
}
$sql = "select * from `stringval_item` where `cat_id`=$cat_id order by `order_string` DESC";
$res = mysqli_query($connect, $sql);
while ($fild = mysqli_fetch_assoc($res)) {
    if ($count > 0) {
        echo(",");
    }
    ?>{"id":"<?php echo($fild['id']); ?>","title":"<?php echo($fild['title']); ?>","order":"<?php echo($fild['order_string']); ?>","type":"string","important":"<?php echo($fild['important']); ?>"}<?php
    $count++;
}
?>]}