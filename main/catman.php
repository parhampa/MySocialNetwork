<?php
if ($admin == false) {
    die();
}
$sql = "select * from `cat` where `father`=0 order by `cat_ord` DESC ";
$res = mysqli_query($connect, $sql);
?>
<table class="w3-table w3-striped w3-bordered w3-animate-left" id="catlistman">
    <tr>
        <td>category title</td>
        <td>order</td>
        <td>actions</td>
    </tr>
    <?php
    while ($fild = mysqli_fetch_assoc($res)) {
        ?>
        <tr>
            <td><?php echo($fild['title']); ?></td>
            <td><?php echo($fild['cat_ord']); ?></td>
            <td>
                <span class="w3-btn w3-green">delete category</span>
                <span class="w3-btn w3-pink" onclick="catmanselitem(<?php echo($fild['id']); ?>)">select items</span>
                <span class="w3-btn w3-blue" onclick="catmanstritem(<?php echo($fild['id']); ?>)">string items</span>
                <span class="w3-btn w3-blue-gray"
                      onclick="catmannumitem(<?php echo($fild['id']); ?>)">numeric items</span>
            </td>
        </tr>
        <?php
        $fatherthiscat = $fild['id'];
        $sql2 = "select * from `cat` where `father`=$fatherthiscat";
        $res2 = mysqli_query($connect, $sql2);
        while ($fild2 = mysqli_fetch_assoc($res2)) {
            ?>
            <tr>
                <td><?php echo("(" . $fild['title'] . ")=>" . $fild2['title']); ?></td>
                <td><?php echo("(" . $fild['cat_ord'] . ")=>" . $fild2['cat_ord']); ?></td>
                <td>
                    <span class="w3-btn w3-green">delete category</span>
                    <span class="w3-btn w3-pink"
                          onclick="catmanselitem(<?php echo($fild2['id']); ?>)">select items</span>
                    <span class="w3-btn w3-blue"
                          onclick="catmanstritem(<?php echo($fild2['id']); ?>)">string items</span>
                    <span class="w3-btn w3-blue-gray" onclick="catmannumitem(<?php echo($fild2['id']); ?>)">numeric items</span>
                </td>
            </tr>
            <?php
        }
    }
    ?>
</table>
<div id="allitemsplc" style="display: none;">
    <span class="w3-btn w3-green" onclick="backmancat()">back</span>
    <div id="resshowitems"></div>
</div>

<br>