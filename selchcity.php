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
$sql = "select * from `post` where `id`=$id and `user`='$user'";
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) == 0) {
    die();
}
$fild = mysqli_fetch_assoc($res);
$city_id = $fild['city_id'];
$sql = "select * from `city` order by `city_ord` DESC";
$res = mysqli_query($connect, $sql);
?>
<select id="changepostcitysel<?php echo($id); ?>">
    <option value=""><?php echo($di_select_a_city); ?></option>
    <?php
    while ($fild = mysqli_fetch_assoc($res)) {
        ?>
        <option value="<?php echo($fild['id']); ?>" <?php if ($fild['id'] == $city_id) {
            echo("selected");
        } ?>><?php echo($fild['title']); ?></option>
        <?php
    }
    ?>
</select>
<input type="button" value="<?php echo($di_save); ?>" onclick="savechangecity(<?php echo($id); ?>)">