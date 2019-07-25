<?php
session_start();
if (isset($_SESSION['user']) == false) {
    die();
}
if ($_SESSION['user'] != "admin") {
    die();
}
include("config.php");
if (isset($_POST['id']) == false) {
    die();
}
$id = sqlint($_POST['id']);
$sql = "select * from `cat` where `id`=$id";
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) > 0) {
    ?>
    <table class="w3-table w3-striped w3-bordered w3-animate-left">
        <tr>
            <td>select title</td>
            <td>order</td>
            <td>actions</td>
        </tr>
        <?php
        $sql = "select * from `selectbox_item` where `cat_id`=$id order by `sel_order` DESC";
        $res = mysqli_query($connect, $sql);
        while ($fild = mysqli_fetch_assoc($res)) {
            ?>
            <tr>
                <td><?php echo($fild['title']); ?></td>
                <td><?php echo($fild['sel_order']); ?></td>
                <td>
                    <span class="w3-btn w3-red">delete</span>

                    <span class="w3-btn w3-green" id="addfilterid<?php echo($fild['id']); ?>"
                          onclick="selectaddfilter(<?php echo($fild['id']); ?>, 1)"
                          style="<?php if ($fild['filter'] == 1) {
                              echo("display:none;");
                          } ?>">add to filter</span>

                    <span class="w3-btn w3-green" id="remfilterid<?php echo($fild['id']); ?>"
                          onclick="selectaddfilter(<?php echo($fild['id']); ?>, 0)"
                          style="<?php if ($fild['filter'] == 0) {
                              echo("display:none;");
                          } ?>">remove from filter</span>
                    <span class="w3-btn w3-blue">edit</span>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}
?>