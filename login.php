<?php
session_start();
include("config.php");
if (isset($_POST['username']) == false) {
    respm("0", $di_login_pm1);
    die();
}
$username = sqlstr($_POST['username']);
if ($username == "") {
    respm("0", $di_login_pm1);
    die();
}
if (isset($_POST['password']) == false) {
    respm("0", $di_login_pm3);
    die();
}
$password = sqlstr($_POST['password']);
if ($password == "") {
    respm("0", $di_login_pm3);
    die();
}
$sql = "select * from `users` where `user`='$username'";
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) == 0) {
    respm("0", $di_login_pm4);
    die();
}
$fild = mysqli_fetch_assoc($res);
$mobile = $fild['mobile'];
$password = md5($password . $mobile);
$sql = "select * from `users` where `user`='$username' and `pass`='$password'";
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) > 0) {
    respm("1", $di_login_pm5);
    $_SESSION['user'] = $username;
    die();
} else {
    respm("0", $di_login_pm6);
    die();
}
?>