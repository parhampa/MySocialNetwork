<?php
session_start();
if (isset($_SESSION['user']) == false) {
    die();
}
$user = $_SESSION['user'];
include("config.php");
if (isset($_GET['id']) == false) {
    die();
}
$id = sqlint($_GET['id']);
$sql = "select * from `post` where `user`='$user' and `id`=$id";
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) == 0) {
    die();
}
$tarikh = date("Y-m-d");
$saat = date("h:i:sa");
$target_dir = "uploads/" . md5($tarikh . $saat . $user);
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
}
if (file_exists($target_file)) {
    $uploadOk = 0;
}
if ($_FILES["fileToUpload"]["size"] > 8000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
    $uploadOk = 0;
}
if ($uploadOk == 0) {
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $sql = "insert into `post_pics` (`address`,`post_id`) VALUES ('$target_file',$id)";
        $res = mysqli_query($connect, $sql);
    } else {
        echo("upload is not ok");
    }
}
?>