<?php
include("../config.php");
if (isset($_GET['id']) == false) {
    die();
}
$id = sqlint($_GET['id']);
$sql = "select * from `cat` where id=$id";
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) > 0) {
    $sql = "select * from `selectbox_item` where `cat_id`=$id and `filter`=1 order by `sel_order` DESC ";
    $res = mysqli_query($connect, $sql);
    while ($fild = mysqli_fetch_assoc($res)) {
        ?>
        <label class="w3-label w3-text-blue"><?php echo($fild['title']); ?> :</label>
        <select class="w3-select w3-border filterselect" id="selectid<?php echo($fild['id']); ?>">
            <option value="">select an item for filtering</option>
            <?php
            $sid = $fild['id'];
            $sql2 = "select * from `selectbox_val` where `sid`=$sid";
            echo($sql2);
            $res2 = mysqli_query($connect, $sql2);
            while ($fild2 = mysqli_fetch_assoc($res2)) {
                ?>
                <option value="<?php echo($fild2['id']); ?>"><?php echo($fild2['title']); ?></option>
                <?php
            }
            ?>
        </select>
        <br>
        <?php
    }
    $sql = "select * from `numericval_item` where `cat_id`=$id and `filter`=1 order by `orderval`";
    $res = mysqli_query($connect, $sql);
    while ($fild = mysqli_fetch_assoc($res)) {
        ?>
        <br>
        <label class="w3-label w3-text-blue"><?php echo($fild['title']); ?> from </label>
        <input type="number" class="filternumber1" id="filternumber1id<?php echo($fild['id']); ?>">
        <label class="w3-label w3-text-blue">to </label>
        <input type="number" class="filternumber2" id="filternumber2id<?php echo($fild['id']); ?>">
        <br>
        <?php
    }

    $sql = "select * from `stringval_item` where `cat_id`=$id and `filter`=1 order by `order_string`";
    $res = mysqli_query($connect, $sql);
    while ($fild = mysqli_fetch_assoc($res)) {
        ?>
        <label class="w3-label w3-text-blue"><?php echo($fild['title']); ?> :</label>
        <input type="text" class="w3-input w3-border filtertext" id="filtertextid<?php echo($fild['id']); ?>">
        <?php
    }
}
?>
<br>
<input type="button" class="w3-btn w3-blue" value="set filter" onclick="sndfilter();">
<br>
<br>
