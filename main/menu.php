<span style="font-size: 12px;" class="w3-text-blue"><?php echo($di_messages); ?> <span class="w3-text-red"
                                                                                       style="width: 15px;">5</span></span>
<div style="height: 40px; width: 100%; margin-top: 10px; margin-bottom: 10px;" class="scrollmenu">
        <span class="w3-btn w3-blue w3-hover-pink"
              onclick="location.replace('main.php')" style="border-radius: 25px;"><?php echo($di_mainpage); ?></span>
    <span class="w3-btn w3-blue w3-hover-pink"
          onclick="location.replace('main.php?filter=1')" style="border-radius: 25px;"><?php echo($di_filtering); ?></span>
    <span class="w3-btn w3-blue w3-hover-pink <?php echo($loginstatus); ?>"
          onclick="addanewpost()" style="border-radius: 25px;"><?php echo($di_add_new_post); ?></span>
    <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;"
          onclick="showcatlist()"><?php echo($di_category); ?></span>
    <?php
    if ($loginstatus != "") {
        ?>
        <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;"
              onclick="location.replace('index.php')"><?php echo($di_login); ?></span>
        <?php
    } else {
        ?>
        <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;"
              onclick="location.replace('logout.php')"><?php echo($di_logout); ?></span>
        <?php
    }
    if ($admin == true) {
        ?>
        <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;"
              onclick="showaddcat()"><?php echo($di_add_cat); ?></span>
        <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;"
              onclick="document.getElementById('addcitym').style.display='block'"><?php echo($di_add_city); ?>  </span>
        <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;"
              onclick="location.replace('main.php?catman=1');"><?php echo($di_catmanage); ?>  </span>
        <span class="w3-btn w3-blue w3-hover-pink" style="border-radius: 25px;"
              onclick="location.replace('main.php?users=1');"><?php echo($di_users); ?>  </span>
        <?php
    }
    ?>
</div>