<?php
session_start();
if (isset($_SESSION['user']) == false) {
    die();
}
$user = $_SESSION['user'];
include("config.php");
$password = "";
if (isset($_POST['password']) == true) {
    $password = sqlstr($_POST['password']);
    if ($password != "") {
        if (isset($_POST['rpassword']) == false) {
            ?>
            <script>
                alert("please insert repeat password...");
                location.replace("profile.php");
            </script>
            <?php
            die();
        }
        $rpassword = sqlstr($_POST['rpassword']);
        if ($password != $rpassword) {
            ?>
            <script>
                alert("your password and  repeat password are not equal...");
                location.replace("profile.php");
            </script>
            <?php
            die();
        }
    }
}
if (isset($_POST['name']) == false) {
    ?>
    <script>
        alert("please enter your name...");
        location.replace("profile.php");
    </script>
    <?php
    die();
}
$name = sqlstr($_POST['name']);
if ($name == "") {
    ?>
    <script>
        alert("please enter your name...");
        location.replace("profile.php");
    </script>
    <?php
    die();
}
if (isset($_POST['family']) == false) {
    ?>
    <script>
        alert("please insert your family...");
        location.replace("profile.php");
    </script>
    <?php
    die();
}
$family = sqlstr($_POST['family']);
if ($family == "") {
    ?>
    <script>
        alert("please enter your family...");
        location.replace("profile.php");
    </script>
    <?php
    die();
}
if (isset($_POST['city']) == false) {
    ?>
    <script>
        alert("please enter your city...");
        location.replace("profile.php");
    </script>
    <?php
    die();
}
$city = sqlint($_POST['city']);
$address = "";
if (isset($_POST['address']) == true) {
    $address = sqlstr($_POST['address']);
}
$profiletext = "";
if (isset($_POST['profiletext']) == true) {
    $profiletext = sqlstr($_POST['profiletext']);
}

$tarikh = date("Y-m-d");
$saat = date("h:i:sa");

$defpic = "";
if (isset($_FILES['defpic']) == true) {
    $target_dir = "uploads/" . md5($tarikh . $saat . $user . "defpic");
    $target_file = $target_dir . basename($_FILES["defpic"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["defpic"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }
    if ($_FILES["defpic"]["size"] > 8000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
    } else {
        if (move_uploaded_file($_FILES["defpic"]["tmp_name"], $target_file)) {
            $defpic = $target_file;
        }
    }
}

$propic = "";
if (isset($_FILES['propic']) == true) {
    $target_dir = "uploads/" . md5($tarikh . $saat . $user . "propic");
    $target_file = $target_dir . basename($_FILES["propic"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["propic"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }
    if ($_FILES["propic"]["size"] > 8000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
    } else {
        if (move_uploaded_file($_FILES["propic"]["tmp_name"], $target_file)) {
            $propic = $target_file;
        }
    }
}
$sql = "select * from `users` where `user`='$user'";
$res = mysqli_query($connect, $sql);
$fild = mysqli_fetch_assoc($res);
$ucity = $fild['city'];
$city_admin = $fild['city_admin'];
if ($city != $ucity) {
    $city_admin = 0;
}
$passq = "";
if ($password != "") {
    $password = md5($password . $fild['mobile']);
    $passq = ",`pass`='$password'";
}
$defpicq = "";
if ($defpic != "") {
    $defpicq = ",`defpic`='$defpic'";
}
$propicq = "";
if ($propic != "") {
    $propicq = ",`picture`='$propic'";
}
$sql = "update `users` set `profiletext`='$profiletext',`name`='$name', `family`='$family',`city`=$city,`city_admin`=$city_admin,`address`='$address' $passq $defpicq $propicq where `user`='$user'";
$res = mysqli_query($connect, $sql);
if ($res) {
    ?>
    <script>
        alert("update is finished...");
    </script>
    <?php
} else {
    ?>
    <script>
        alert("we cant update your profile!!!");
    </script>
    <?php
    //die($sql);
}
?>
<script>
    location.replace("main.php?profile=1");
</script>
