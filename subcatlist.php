<?php
include("config.php");
if (isset($_POST['id']) == false) {
    die();
}
$id = sqlint($_POST['id']);
$sql = "select * from `cat` where `father`=$id";
$res = mysqli_query($connect, $sql);
while ($fild = mysqli_fetch_assoc($res)) {
    ?>
    <span class="w3-btn w3-pink" onclick="filtercat(<?php echo($fild['id']); ?>)"><?php echo($fild['title']); ?></span>
    <?php
}
?>
<span class="w3-btn w3-pink" onclick="showcatlist()">back</span>
