<div id="categorylist" class="w3-modal">
            <span class="w3-button w3-red w3-hover-red w3-xlarge w3-display-topright"
                  onclick="document.getElementById('categorylist').style.display='none'">&times;</span>
    <div class="w3-modal-content w3-animate-zoom" style="padding: 10px;">
        <div id="parrentcats" style="padding-top: 50px ; padding-bottom: 50px;">
            <?php
            $sqlcat = "select * from `cat` where `father`=0 order by `cat_ord` DESC";
            $rescat = mysqli_query($connect, $sqlcat);
            while ($fildcat = mysqli_fetch_assoc($rescat)) {
                ?>
                <span class="w3-btn w3-green"
                      onclick="showsubcatlist(<?php echo($fildcat['id']); ?>)"><?php echo($fildcat['title']); ?></span>
                <?php
            }
            ?>
        </div>
        <div id="subparrentcats" style="padding-top: 50px ; padding-bottom: 50px;">
        </div>
    </div>
</div>