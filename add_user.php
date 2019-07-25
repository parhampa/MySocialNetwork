<?php
include("config.php");

if (isset($_POST['user']) == false) {
    respm("0", $di_add_user_pm1);
    die();
}
$user = sqlstr($_POST['user']);
if ($user == "") {
    respm("0", $di_add_user_pm2);
    die();
}
$sql = "select * from users where `user`='$user'";
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) > 0) {
    respm("0", $di_add_user_pm3);
    die();
}
if (isset($_POST['pass']) == false) {
    respm("0", $di_add_user_pm4);
    die();
}
$pass = sqlstr($_POST['pass']);
if ($pass == "") {
    respm("0", $di_add_user_pm4);
    die();
}
if (isset($_POST['pass1']) == false) {
    respm("0", $di_add_user_pm5);
    die();
}
$pass1 = sqlstr($_POST['pass1']);
if ($pass1 == "") {
    respm("0", $di_add_user_pm5);
    die();
}
if ($pass != $pass1) {
    respm("0", $di_add_user_pm6);
    die();
}
$email = "";
if (isset($_POST['email']) == true) {
    $email = sqlstr($_POST['email']);
}
if (isset($_POST['mobile']) == false) {
    respm("0", $di_add_user_pm7);
    die();
}
$mobile = sqlstr($_POST['mobile']);
if ($mobile == "") {
    respm("0", $di_add_user_pm7);
    die();
}
if (isset($_POST['name1']) == false) {
    respm("0", $di_add_user_pm8);
    die();
}
$name = sqlstr($_POST['name1']);
if ($name == "") {
    respm("0", $di_add_user_pm8);
    die();
}
if (isset($_POST['family1']) == false) {
    respm("0", $di_add_user_pm9);
    die();
}
$family = sqlstr($_POST['family1']);
if ($family == "") {
    respm("0", $di_add_user_pm9);
    die();
}
if (isset($_POST['city']) == false) {
    respm("0", $di_add_user_pm10);
    die();
}
$city = sqlint($_POST['city']);
/*if ($city == "") {
    respm("0", $di_add_user_pm10);
    die();
}*/
$regdate = date("Y-m-d");
$picture = "";
$profiletext = "";
$pass = md5($pass . $mobile);
$sql = "insert into users (`user`,`pass`,`email`,`mobile`,`name`,`family`,`regdate`,`city`,`picture`,`profiletext`)
VALUES ('$user','$pass','$email','$mobile','$name','$family','$regdate',$city,'$picture','$profiletext')";
$res = mysqli_query($connect, $sql);
if (!$res) {
    respm("0", $di_add_user_pm11);
    die();
} else {
    respm("1", $di_add_user_pm12);
}
?>