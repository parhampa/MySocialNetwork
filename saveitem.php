<?php
session_start();
if (isset($_SESSION['user']) == false) {
    die();
}
$user = $_SESSION['user'];
include("config.php");
if (isset($_POST['id']) == false) {
    die();
}
$id = sqlint($_POST['id']);
if (isset($_POST['str']) == true) {
    if (isset($_POST['valuee']) == false) {
        die();
    }
    $val = sqlstr($_POST['valuee']);
    $sql = "select * from `post_string` where `id`=$id";
    $res = mysqli_query($connect, $sql);
    if (mysqli_num_rows($res) == 1) {
        $fild = mysqli_fetch_assoc($res);
        $post_id = $fild['post_id'];
        $sql = "select * from `post` where `id`=$post_id and `user`='$user'";
        $res = mysqli_query($connect, $sql);
        if (mysqli_num_rows($res) == 1) {
            $fild = mysqli_fetch_assoc($res);
            $puser = $fild['user'];
            if ($puser = $user) {
                $sql = "update `post_string` set `value`='$val' where `id`=$id";
                $res = mysqli_query($connect, $sql);
            }
        }
    }
}
if (isset($_POST['numer']) == true) {
    if (isset($_POST['valuee']) == false) {
        die();
    }
    $val = sqlint($_POST['valuee']);
    $sql = "select * from `post_numericval` where `id`=$id";
    $res = mysqli_query($connect, $sql);
    if (mysqli_num_rows($res) == 1) {
        $fild = mysqli_fetch_assoc($res);
        $post_id = $fild['post_id'];
        $sql = "select * from `post` where `id`=$post_id and `user`='$user'";
        $res = mysqli_query($connect, $sql);
        if (mysqli_num_rows($res) == 1) {
            $fild = mysqli_fetch_assoc($res);
            $puser = $fild['user'];
            if ($puser = $user) {
                $sql = "update `post_numericval` set `value`='$val' where `id`=$id";
                $res = mysqli_query($connect, $sql);
            }
        }
    }
}
if (isset($_POST['selectt']) == true) {
    if (isset($_POST['valuee']) == true) {
        $valuee = sqlint($_POST['valuee']);
        $sql = "select * from `post_select` where `id`=$id";
        $res = mysqli_query($connect, $sql);
        if (mysqli_num_rows($res) != 0) {
            $fild = mysqli_fetch_assoc($res);
            $post_id = $fild['post_id'];
            $sql = "select * from `post` where `id`=$post_id and `user`='$user'";
            $res = mysqli_query($connect, $sql);
            if (mysqli_num_rows($res) != 0) {
                $fild = mysqli_fetch_assoc($res);
                $puser = $fild['user'];
                if ($user == $puser) {
                    $sql = "update `post_select` set `selval`=$valuee where `id`=$id";
                    $res = mysqli_query($connect, $sql);
                }
            }
        }
    }
}
?>