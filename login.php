<?php
session_start();
include("config.php");
if (isset($_POST['username']) == false) {
    respm("0", "please insert your username...");
    die();
}
$username = sqlstr($_POST['username']);
if ($username == "") {
    respm("0", "please insert your username...");
    die();
}
if (isset($_POST['password']) == false) {
    respm("0", "please insert your password...");
    die();
}
$password = sqlstr($_POST['password']);
if ($password == "") {
    respm("0", "please insert your password...");
    die();
}
$sql = "select * from `users` where `user`='$username'";
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) == 0) {
    respm("0", "your username is not valid...");
    die();
}
$fild = mysqli_fetch_assoc($res);
$mobile = $fild['mobile'];
$password = md5($password . $mobile);
$sql = "select * from `users` where `user`='$username' and `pass`='$password'";
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) > 0) {
    respm("1", "you are logged in...");
    $_SESSION['user'] = $username;
    die();
} else {
    respm("0", "your username or password is wrong...");
    die();
}
?>