<?php
include("config.php");

if (isset($_POST['user']) == false) {
    respm("0", "please insert your username...");
    die();
}
$user = sqlstr($_POST['user']);
if ($user == "") {
    respm("0", "please insert your username...");
    die();
}
$sql = "select * from users where `user`='$user'";
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) > 0) {
    respm("0", "this user is used before please try another one...");
    die();
}
if (isset($_POST['pass']) == false) {
    respm("0", "please insert your password...");
    die();
}
$pass = sqlstr($_POST['pass']);
if ($pass == "") {
    respm("0", "please insert your password...");
    die();
}
if (isset($_POST['pass1']) == false) {
    respm("0", "please insert your password again...");
    die();
}
$pass1 = sqlstr($_POST['pass1']);
if ($pass1 == "") {
    respm("0", "please insert your password again...");
    die();
}
if ($pass != $pass1) {
    respm("0", "password and again password are not equal...");
    die();
}
$email = "";
if (isset($_POST['email']) == true) {
    $email = sqlstr($_POST['email']);
}
if (isset($_POST['mobile']) == false) {
    respm("0", "please insert your mobile number...");
    die();
}
$mobile = sqlstr($_POST['mobile']);
if ($mobile == "") {
    respm("0", "please insert your mobile number...");
    die();
}
if (isset($_POST['name1']) == false) {
    respm("0", "please insert your name...");
    die();
}
$name = sqlstr($_POST['name1']);
if ($name == "") {
    respm("0", "please insert your name...");
    die();
}
if (isset($_POST['family1']) == false) {
    respm("0", "please insert your family...");
    die();
}
$family = sqlstr($_POST['family1']);
if ($family == "") {
    respm("0", "please insert your family...");
    die();
}
if (isset($_POST['city']) == false) {
    respm("0", "please insert your city...");
    die();
}
$city = sqlstr($_POST['city']);
if ($city == "") {
    respm("0", "please insert your city...");
    die();
}
$regdate = date("Y-m-d");
$picture = "";
$profiletext = "";
$pass=md5($pass.$mobile);
$sql = "insert into users (`user`,`pass`,`email`,`mobile`,`name`,`family`,`regdate`,`city`,`picture`,`profiletext`)
VALUES ('$user','$pass','$email','$mobile','$name','$family','$regdate','$city','$picture','$profiletext')";
$res = mysqli_query($connect, $sql);
if (!$res) {
    respm("0", "we have problem in registration...");
    die();
} else {
    respm("1", "you are in. congratulations...");
}
?>