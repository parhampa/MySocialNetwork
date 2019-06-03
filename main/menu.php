<span style="font-size: 12px;" class="w3-text-blue">messages <span class="w3-text-red" style="width: 15px;">5</span></span>
<div style="height: 40px; width: 100%; margin-top: 10px; margin-bottom: 10px;" class="scrollmenu">
        <span class="w3-btn w3-blue w3-hover-pink <?php echo($loginstatus); ?>"
              onclick="addanewpost()" style="border-radius: 25px;">add a new post</span>
    <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;" onclick="showcatlist()">category</span>
    <?php
    if ($loginstatus != "") {
        ?>
        <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;"
              onclick="location.replace('index.php')">login</span>
        <?php
    } else {
        ?>
        <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;"
              onclick="location.replace('logout.php')">logout</span>
        <?php
    }
    if ($admin == true) {
        ?>
        <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;"
              onclick="showaddcat()">add category</span>
        <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;"
              onclick="document.getElementById('addcitym').style.display='block'">add city</span>
        <?php
    }
    ?>
</div>