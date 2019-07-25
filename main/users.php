<?php
if ($admin == false) {
    die();
}
$sql = "select * from `users`";
$res = mysqli_query($connect, $sql);
?>
<table class="w3-table w3-striped w3-bordered w3-animate-left" id="catlistman">
    <tr>
        <td>username</td>
        <td>name</td>
        <td>family</td>
        <td>email</td>
        <td>mobile</td>
        <td>actions</td>
    </tr>
    <?php
    while ($fild = mysqli_fetch_assoc($res)) {
        ?>
        <tr>
            <td><?php echo($fild['user']); ?></td>
            <td><?php echo($fild['name']); ?></td>
            <td><?php echo($fild['family']); ?></td>
            <td><?php echo($fild['email']); ?></td>
            <td><?php echo($fild['mobile']); ?></td>
            <td>

                <span class="w3-button w3-green" id="userdis<?php echo($fild['user']); ?>"
                      style="<?php if ($fild['active'] == 0) {
                          echo("display: none;");
                      } ?>"
                      onclick="useractiviti('<?php echo($fild['user']); ?>',0)">disable</span>
                <span class="w3-button w3-green" id="useren<?php echo($fild['user']); ?>"
                      style="<?php if ($fild['active'] == 1) {
                          echo("display: none;");
                      } ?>"
                      onclick="useractiviti('<?php echo($fild['user']); ?>',1)">enable</span>

                <span class="w3-button w3-pink" id="useradminyes<?php echo($fild['user']); ?>"
                      style="<?php if ($fild['shop_admin'] == 0) {
                          echo("display: none;");
                      } ?>"
                      onclick="useradmin('<?php echo($fild['user']); ?>',0)">remove admin</span>
                <span class="w3-button w3-pink" id="useradminno<?php echo($fild['user']); ?>"
                      style="<?php if ($fild['shop_admin'] == 1) {
                          echo("display: none;");
                      } ?>"
                      onclick="useradmin('<?php echo($fild['user']); ?>',1)">add user admin</span>

                <span class="w3-button w3-blue" id="usercityyes<?php echo($fild['user']); ?>"
                      style="<?php if ($fild['city_admin'] == 0) {
                          echo("display: none;");
                      } ?>"
                      onclick="usercityadmin('<?php echo($fild['user']); ?>',0)">remove city admin</span>
                <span class="w3-button w3-blue" id="usercityno<?php echo($fild['user']); ?>"
                      style="<?php if ($fild['city_admin'] == 1) {
                          echo("display: none;");
                      } ?>"
                      onclick="usercityadmin('<?php echo($fild['user']); ?>',1)">add city admin</span>

            </td>
        </tr>
        <?php
    }
    ?>
</table>
<br>
