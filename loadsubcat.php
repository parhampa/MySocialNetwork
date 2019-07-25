<?php
session_start();
if (isset($_SESSION['user']) == false) {
    die();
}
include("config.php");
if (isset($_POST['fcat']) == false) {
    die();
}
if ($_POST['fcat'] == "") {
    die();
}
$fcat = sqlint($_POST['fcat']);
$sql = "select * from cat where `father`=$fcat";
$res = mysqli_query($connect, $sql);
?>
<select class="w3-select w3-border" id="add_subcat" onchange="loadmorinfo();">
    <option value="0"><?php echo($di_selectsubcat); ?></option>
    <?php
    while ($fild = mysqli_fetch_assoc($res)) {
        ?>
        <option value="<?php echo($fild['id']); ?>"><?php echo($fild['title']); ?></option>
        <?php
    }
    ?>
</select>

