<?php
session_start();
$loginstatus = "";
$user = "";
if (isset($_SESSION['user']) == false) {
    $loginstatus = "w3-disabled";
} else {
    $user = $_SESSION['user'];
}
$admin = false;
if (isset($_SESSION['user']) == true) {
    if ($_SESSION['user'] == 'admin') {
        $admin = true;
    }
}
include("config.php");
?>
<html>
<head>
    <?php include("main/head.php"); ?>
</head>
<body class="backload">
<div style="width: 80%; margin-left: 10%;" class="w3-white w3-panel w3-card-2" id="mainpart">
    <?php
    include("main/menu.php");
    include("main/selcity.php");
    include("main/selcat.php");
    ?>
    <?php
    if ($admin == true) {
        include("main/addcity.php");
        include("main/addcat.php");
    }
    if (isset($_GET['users']) == true && $admin == true) {
        include("main/users.php");
    } elseif (isset($_GET['catman']) == true && $admin == true) {
        include("main/catman.php");
    } else {
        if ($user != "") {
            include("main/addpost.php");
            if ($admin == true) {
                include("main/topbtn.php");
            }
        }
        if (isset($_GET['all']) == true) {
            if ($_GET['all'] == 1) {
                $_COOKIE['city'] = "0";
            }
        }
        if (isset($_GET['filter']) == true) {
            include("main/filtering.php");
        } elseif (isset($_GET['profile']) == true && $user != "") {
            include("main/profile.php");
        } else {
            include("main/filter.php");
            include("main/posts.php");
        }
    }
    ?>
</div>
</body>
<script src="js/myjs.js"></script>
</html>