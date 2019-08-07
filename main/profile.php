<?php
$sqlprofile = "select * from `users` where `user`='$user'";
$resprofile = mysqli_query($connect, $sqlprofile);
$fildprofile = mysqli_fetch_assoc($resprofile);
?>
<form action="editprofile.php" method="post" enctype="multipart/form-data">
    <label class="w3-text-blue">username : </label>
    <input type="text" name="user" class="w3-input w3-border" placeholder="your username"
           value="<?php echo($fildprofile['user']); ?>" disabled>
    <label class="w3-text-blue">password : </label>
    <input type="password" name="password" class="w3-input w3-border" placeholder="your password">
    <label class="w3-text-blue">repeat password : </label>
    <input type="password" name="rpassword" class="w3-input w3-border" placeholder="your password">
    <label class="w3-text-blue">name : </label>
    <input type="text" name="name" class="w3-input w3-border" placeholder="your name"
           value="<?php echo($fildprofile['name']); ?>">
    <label class="w3-text-blue">family : </label>
    <input type="text" name="family" class="w3-input w3-border" placeholder="your family"
           value="<?php echo($fildprofile['family']); ?>">
    <br>
    <div style="width: 100%; padding: 10px;" class="w3-red w3-card-2 w3-round-medium ">
        <?php
        if ($fildprofile['picture'] != "") {
            ?>
            <div style="width: 100%; text-align: center;">
                <img src="<?php echo($fildprofile['defpic']); ?>" height="200px;"><br>
            </div>
            <?php
        }
        ?>
        <label class="w3-text-blue">default picture : </label>
        <input class="w3-input w3-border" type="file" name="defpic">
    </div>
    <br>
    <div style="width: 100%; padding: 10px;" class="w3-dark-gray w3-card-2 w3-round-medium ">
        <?php
        if ($fildprofile['picture'] != "") {
            ?>
            <div style="width: 100%; text-align: center;">
                <img src="<?php echo($fildprofile['picture']); ?>" height="200px;"><br>
            </div>
            <?php
        }
        ?>
        <label class="w3-text-blue">profile picture : </label>
        <input class="w3-input w3-border" type="file" name="propic">
    </div>
    <br>
    <label class="w3-text-blue">city : </label>
    <select class="w3-select w3-border" name="city" id="rcity">
        <option value=""><?php echo($di_select_your_city); ?></option>
        <?php
        $sqlcl = "select * from `city` order by `city_ord` DESC ";
        $rescl = mysqli_query($connect, $sqlcl);
        while ($fildcl = mysqli_fetch_assoc($rescl)) {
            ?>
            <option value="<?php echo($fildcl['id']); ?>" <?php
            if ($fildprofile['city'] == $fildcl['id']) {
                echo("selected");
            }
            ?>><?php echo($fildcl['title']); ?></option>
            <?php
        }
        ?>
    </select>
    <br>
    <label class="w3-text-blue">profile text : </label>
    <textarea name="profiletext" class="w3-input w3-border"><?php
        echo($fildprofile['profiletext']);
        ?></textarea>
    <label class="w3-text-blue">address : </label>
    <textarea name="address" class="w3-input w3-border"><?php
        echo($fildprofile['address']);
        ?></textarea>
    <br>

    <input type="submit" value="edit profile" class="w3-btn w3-green">
</form>