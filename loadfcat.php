<?php
session_start();
if (isset($_SESSION['user']) == false) {
    die();
}
if ($_SESSION['user'] != "admin") {
    die();
}
include("config.php");
if (isset($_GET['scat']) == true) {
    $sql = "select * from cat where `father`=0 ORDER BY `cat_ord` DESC ";
    $res = mysqli_query($connect, $sql);
    while ($fild = mysqli_fetch_assoc($res)) {
        ?>
        <br><br><span class="w3-btn w3-pink w3-round-xxlarge"
                      onclick="docat(<?php echo($fild['id']); ?>,'<?php echo($fild['title']); ?>','<?php echo($fild['father']); ?>',<?php echo($fild['cat_ord']); ?>)"><?php echo($fild['title']); ?></span>
        <br><br>
        <?php
        $father = $fild['id'];
        $sql2 = "select * from cat where `father`=$father order by `cat_ord` DESC ";
        $res2 = mysqli_query($connect, $sql2);
        while ($fild2 = mysqli_fetch_assoc($res2)) {
            ?>
            <span class="w3-btn w3-green w3-round-xxlarge"
                  onclick="docat(<?php echo($fild2['id']); ?>,'<?php echo($fild2['title']); ?>','<?php echo($fild2['father']); ?>',<?php echo($fild2['cat_ord']); ?>)"><?php echo($fild2['title']); ?></span>
            <?php
        }
    }
} else {
    ?>
    <option value="0">your category father</option>
    <?php

    $sql = "select * from cat where `father`=0 order by `cat_ord` DESC";
    $res = mysqli_query($connect, $sql);
    while ($fild = mysqli_fetch_assoc($res)) {
        ?>
        <option value="<?php echo($fild['id']); ?>"><?php echo($fild['title']); ?></option>
        <?php
    }
}
?>