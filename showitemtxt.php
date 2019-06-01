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
if (isset($_GET['t']) == true) {
    $sql = "select * from `post_string` where id=$id";
    $res = mysqli_query($connect, $sql);
    if (mysqli_num_rows($res) == 1) {
        $fild = mysqli_fetch_assoc($res);
        $value = $fild['value'];
        $post_id = $fild['post_id'];
        $sql2 = "select * from `post` where `id`=$post_id";
        $res2 = mysqli_query($connect, $sql2);
        $fild2 = mysqli_fetch_assoc($res2);
        if ($fild2['user'] == $user) {
            echo($value);
        }
    }
}
if (isset($_GET['s']) == true) {
    $sql = "select * from `post_select` where `id`=$id";
    $res = mysqli_query($connect, $sql);
    if (mysqli_num_rows($res) > 0) {
        $fild = mysqli_fetch_assoc($res);
        $post_id = $fild['post_id'];
        $select_id = $fild['select_id'];
        $selval = $fild['selval'];
        $sql2 = "select * from `post` where `id`=$post_id AND `user`='$user'";
        $res2 = mysqli_query($connect, $sql);
        if (mysqli_num_rows($res2) > 0) {
            $sql3 = "select * from `selectbox_val` where `sid`=$select_id";
            $res3 = mysqli_query($connect, $sql3);
            ?>
            <select id="esel<?php echo($id); ?>">
                <?php
                while ($fild3 = mysqli_fetch_assoc($res3)) {
                    ?>
                    <option value="<?php echo($fild3['id']); ?>" <?php if ($selval == $fild3['id']) {
                        echo("selected");
                    } ?>><?php echo($fild3['title']); ?></option>
                    <?php
                }
                ?>
            </select>
            <input type="button" onclick="savesel(<?php echo($id); ?>,<?php echo($post_id); ?>);" value="save">
            <input type="button" onclick="canselsel(<?php echo($post_id); ?>);" value="cancel">
            <?php
        }
    }
}
?>