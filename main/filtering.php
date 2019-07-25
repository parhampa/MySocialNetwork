<?php
$sqlcat = "select * from `cat` where `father`=0 order by `cat_ord` DESC ";
$rescat = mysqli_query($connect, $sqlcat);
?>
<br>
<label class="w3-label w3-text-blue">category :</label>
<select class="w3-select w3-border" onchange="loadfilteritmes(this.value);" id="filtercat">
    <option value="">select a category</option>
    <?php
    while ($fild = mysqli_fetch_assoc($rescat)) {
        ?>
        <option value="<?php echo($fild['id']); ?>"><?php echo($fild['title']); ?></option>
        <?php
        $father = $fild['id'];
        $sqlsubcat = "select * from `cat` where `father`=$father";
        $ressubcat = mysqli_query($connect, $sqlsubcat);
        while ($fild2 = mysqli_fetch_assoc($ressubcat)) {
            ?>
            <option value="<?php echo($fild2['id']); ?>"> -- <?php echo($fild2['title']); ?></option>
            <?php
        }
    }
    ?>
</select>
<br>
<br>
<div id="resfilteritems"></div>